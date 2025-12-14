#!/bin/bash

#####################################################################
# PHPMyAdmin Password Generator
# Description: Generates BasicAuth credentials for PHPMyAdmin
# Author: Professional Security Setup
# Date: $(date +%Y-%m-%d)
#####################################################################

# Color codes for better output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Header
echo -e "${BLUE}╔════════════════════════════════════════════════════╗${NC}"
echo -e "${BLUE}║    PHPMyAdmin BasicAuth Password Generator        ║${NC}"
echo -e "${BLUE}╔════════════════════════════════════════════════════╗${NC}"
echo ""

# Check if htpasswd or openssl is available
if ! command -v htpasswd &> /dev/null && ! command -v openssl &> /dev/null; then
    echo -e "${RED}Error: Neither htpasswd nor openssl is available!${NC}"
    echo -e "${YELLOW}Please install apache2-utils (for htpasswd) or openssl${NC}"
    exit 1
fi

# Prompt for username
echo -e "${YELLOW}Enter username for PHPMyAdmin access:${NC}"
read -p "Username [default: admin]: " USERNAME
USERNAME=${USERNAME:-admin}

# Validate username
if [[ ! "$USERNAME" =~ ^[a-zA-Z0-9_-]+$ ]]; then
    echo -e "${RED}Error: Username can only contain letters, numbers, underscore, and hyphen!${NC}"
    exit 1
fi

# Prompt for password
echo ""
echo -e "${YELLOW}Enter password for PHPMyAdmin access:${NC}"
read -sp "Password: " PASSWORD
echo ""

if [ -z "$PASSWORD" ]; then
    echo -e "${RED}Error: Password cannot be empty!${NC}"
    exit 1
fi

# Confirm password
read -sp "Confirm password: " PASSWORD_CONFIRM
echo ""

if [ "$PASSWORD" != "$PASSWORD_CONFIRM" ]; then
    echo -e "${RED}Error: Passwords do not match!${NC}"
    exit 1
fi

# Check password strength
if [ ${#PASSWORD} -lt 8 ]; then
    echo -e "${YELLOW}Warning: Password is weak (less than 8 characters)${NC}"
    read -p "Continue anyway? (y/n): " CONTINUE
    if [ "$CONTINUE" != "y" ]; then
        exit 0
    fi
fi

echo ""
echo -e "${BLUE}🔐 Generating password hash...${NC}"

# Generate password hash
if command -v htpasswd &> /dev/null; then
    # Using htpasswd (preferred method)
    HASH=$(htpasswd -nbB "$USERNAME" "$PASSWORD" 2>/dev/null)
else
    # Using openssl as fallback
    HASH_ONLY=$(echo "$PASSWORD" | openssl passwd -apr1 -stdin)
    HASH="$USERNAME:$HASH_ONLY"
fi

if [ -z "$HASH" ]; then
    echo -e "${RED}Error: Failed to generate password hash!${NC}"
    exit 1
fi

# Escape $ signs for docker-compose (double $$)
ESCAPED_HASH=$(echo "$HASH" | sed 's/\$/\$\$/g')

echo ""
echo -e "${GREEN}✓ Password hash generated successfully!${NC}"
echo ""
echo -e "${BLUE}═══════════════════════════════════════════════════${NC}"
echo -e "${YELLOW}📋 Configuration for docker-compose.yaml${NC}"
echo -e "${BLUE}═══════════════════════════════════════════════════${NC}"
echo ""
echo -e "${YELLOW}Add this line to your PHPMyAdmin labels:${NC}"
echo ""
echo -e "${GREEN}      - \"traefik.http.middlewares.pma-auth.basicauth.users=${ESCAPED_HASH}\"${NC}"
echo ""
echo -e "${BLUE}═══════════════════════════════════════════════════${NC}"
echo ""
echo -e "${YELLOW}📝 Complete PHPMyAdmin labels section should include:${NC}"
echo ""
cat << EOF
    labels:
      - "traefik.enable=true"

      # HTTP Router
      - "traefik.http.routers.pma-mitalimart-http.rule=Host(\`pma.mitalimart.com\`)"
      - "traefik.http.routers.pma-mitalimart-http.entrypoints=http"
      - "traefik.http.routers.pma-mitalimart-http.middlewares=redirect-to-https@docker"

      # HTTPS Router (with BasicAuth)
      - "traefik.http.routers.pma-mitalimart.rule=Host(\`pma.mitalimart.com\`)"
      - "traefik.http.routers.pma-mitalimart.entrypoints=https"
      - "traefik.http.routers.pma-mitalimart.tls=true"
      - "traefik.http.routers.pma-mitalimart.tls.certresolver=cloudflare"
      - "traefik.http.routers.pma-mitalimart.middlewares=pma-auth@docker"

      # BasicAuth Middleware
      - "traefik.http.middlewares.pma-auth.basicauth.users=${ESCAPED_HASH}"
      - "traefik.http.middlewares.pma-auth.basicauth.realm=PHPMyAdmin Access - Authorized Only"

      # Service
      - "traefik.http.services.pma-mitalimart.loadbalancer.server.port=80"
EOF

echo ""
echo -e "${BLUE}═══════════════════════════════════════════════════${NC}"
echo ""
echo -e "${YELLOW}💡 Next Steps:${NC}"
echo ""
echo -e "1. Update docker-compose.yaml with the generated configuration"
echo -e "2. Restart PHPMyAdmin container:"
echo -e "   ${BLUE}docker compose up -d phpmyadmin${NC}"
echo ""
echo -e "3. Access PHPMyAdmin at: ${GREEN}https://pma.mitalimart.com${NC}"
echo -e "   - You'll be prompted for BasicAuth credentials first"
echo -e "   - Then you'll see the PHPMyAdmin login page"
echo ""
echo -e "${YELLOW}📝 Your Credentials:${NC}"
echo -e "   Username: ${GREEN}${USERNAME}${NC}"
echo -e "   Password: ${GREEN}[HIDDEN]${NC}"
echo ""
echo -e "${YELLOW}⚠️  Security Notes:${NC}"
echo -e "   • Store these credentials securely"
echo -e "   • Don't share them via insecure channels"
echo -e "   • Consider IP whitelisting for extra security"
echo -e "   • Change the password regularly"
echo ""
echo -e "${BLUE}════════════════════════════════════════════════════${NC}"
echo -e "${GREEN}✨ Password generation completed!${NC}"
echo -e "${BLUE}════════════════════════════════════════════════════${NC}"

