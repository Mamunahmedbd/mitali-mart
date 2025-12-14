#!/bin/bash

#####################################################################
# WordPress Permissions Fix Script
# Description: Fixes file ownership and permissions for WordPress
# Author: Professional WordPress Setup
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
echo -e "${BLUE}║      WordPress Permissions Fix - Docker           ║${NC}"
echo -e "${BLUE}╔════════════════════════════════════════════════════╗${NC}"
echo ""

# Check if Docker is running
if ! docker ps > /dev/null 2>&1; then
    echo -e "${RED}Error: Docker is not running or you don't have permission to access it!${NC}"
    echo -e "${YELLOW}Please start Docker or run this script with appropriate permissions.${NC}"
    exit 1
fi

# Detect WordPress container
echo -e "${BLUE}🔍 Detecting WordPress container...${NC}"
WP_CONTAINER=$(docker ps --format '{{.Names}}' | grep -iE 'wordpress|mitalimart' | head -n 1)

if [ -z "$WP_CONTAINER" ]; then
    echo -e "${YELLOW}WordPress container not found!${NC}"
    echo -e "${YELLOW}Available containers:${NC}"
    docker ps --format "table {{.Names}}\t{{.Image}}"
    echo ""
    read -p "Enter the exact WordPress container name: " WP_CONTAINER

    if [ -z "$WP_CONTAINER" ]; then
        echo -e "${RED}Error: Container name cannot be empty!${NC}"
        exit 1
    fi
fi

echo -e "${GREEN}✓ Found container: ${WP_CONTAINER}${NC}"
echo ""

# Check if container is running
if ! docker ps --format '{{.Names}}' | grep -q "^${WP_CONTAINER}$"; then
    echo -e "${RED}Error: Container '${WP_CONTAINER}' is not running!${NC}"
    exit 1
fi

# Show current permissions
echo -e "${BLUE}📋 Current permissions:${NC}"
docker exec "$WP_CONTAINER" ls -la /var/www/html/wp-content/ 2>/dev/null | head -10
echo ""

# Ask for confirmation
read -p "Do you want to fix WordPress file permissions? (y/n): " CONFIRM

if [ "$CONFIRM" != "y" ]; then
    echo -e "${YELLOW}Operation cancelled.${NC}"
    exit 0
fi

echo ""
echo -e "${BLUE}🔧 Fixing WordPress Permissions...${NC}"
echo ""

# Fix ownership
echo -e "${BLUE}📂 Step 1/4: Setting correct ownership (www-data:www-data)...${NC}"
if docker exec "$WP_CONTAINER" chown -R www-data:www-data /var/www/html/wp-content 2>/dev/null; then
    echo -e "${GREEN}✓ Ownership updated successfully${NC}"
else
    echo -e "${RED}✗ Failed to change ownership${NC}"
fi
echo ""

# Fix directory permissions
echo -e "${BLUE}📁 Step 2/4: Setting directory permissions (755)...${NC}"
if docker exec "$WP_CONTAINER" find /var/www/html/wp-content -type d -exec chmod 755 {} \; 2>/dev/null; then
    echo -e "${GREEN}✓ Directory permissions set to 755 (rwxr-xr-x)${NC}"
else
    echo -e "${YELLOW}⚠ Could not set all directory permissions${NC}"
fi
echo ""

# Fix file permissions
echo -e "${BLUE}📄 Step 3/4: Setting file permissions (644)...${NC}"
if docker exec "$WP_CONTAINER" find /var/www/html/wp-content -type f -exec chmod 644 {} \; 2>/dev/null; then
    echo -e "${GREEN}✓ File permissions set to 644 (rw-r--r--)${NC}"
else
    echo -e "${YELLOW}⚠ Could not set all file permissions${NC}"
fi
echo ""

# Ensure critical directories exist and are writable
echo -e "${BLUE}📤 Step 4/4: Ensuring critical directories exist...${NC}"

# Create and fix uploads directory
if docker exec "$WP_CONTAINER" sh -c "mkdir -p /var/www/html/wp-content/uploads && chown www-data:www-data /var/www/html/wp-content/uploads && chmod 755 /var/www/html/wp-content/uploads" 2>/dev/null; then
    echo -e "${GREEN}✓ Uploads directory ready${NC}"
fi

# Create and fix upgrade directory
if docker exec "$WP_CONTAINER" sh -c "mkdir -p /var/www/html/wp-content/upgrade && chown www-data:www-data /var/www/html/wp-content/upgrade && chmod 755 /var/www/html/wp-content/upgrade" 2>/dev/null; then
    echo -e "${GREEN}✓ Upgrade directory ready${NC}"
fi

# Fix themes directory
if docker exec "$WP_CONTAINER" sh -c "chown -R www-data:www-data /var/www/html/wp-content/themes && chmod 755 /var/www/html/wp-content/themes" 2>/dev/null; then
    echo -e "${GREEN}✓ Themes directory ready${NC}"
fi

# Fix plugins directory
if docker exec "$WP_CONTAINER" sh -c "chown -R www-data:www-data /var/www/html/wp-content/plugins && chmod 755 /var/www/html/wp-content/plugins" 2>/dev/null; then
    echo -e "${GREEN}✓ Plugins directory ready${NC}"
fi

echo ""

# Verify permissions
echo -e "${BLUE}🔍 Verifying final permissions...${NC}"
echo ""
docker exec "$WP_CONTAINER" ls -la /var/www/html/wp-content/ 2>/dev/null | grep -E "uploads|themes|plugins|upgrade"

echo ""
echo -e "${GREEN}═══════════════════════════════════════════════════${NC}"
echo -e "${GREEN}✓ WordPress permissions fixed successfully!${NC}"
echo -e "${GREEN}═══════════════════════════════════════════════════${NC}"
echo ""
echo -e "${YELLOW}📝 Summary of changes:${NC}"
echo ""
echo -e "  ${BLUE}Ownership:${NC}"
echo -e "    • Owner: ${GREEN}www-data${NC}"
echo -e "    • Group: ${GREEN}www-data${NC}"
echo ""
echo -e "  ${BLUE}Permissions:${NC}"
echo -e "    • Directories: ${GREEN}755${NC} (rwxr-xr-x) - Owner can read/write/execute, others can read/execute"
echo -e "    • Files: ${GREEN}644${NC} (rw-r--r--) - Owner can read/write, others can only read"
echo ""
echo -e "  ${BLUE}Directories ensured:${NC}"
echo -e "    • ${GREEN}wp-content/uploads/${NC} - For media uploads"
echo -e "    • ${GREEN}wp-content/upgrade/${NC} - For WordPress updates"
echo -e "    • ${GREEN}wp-content/themes/${NC} - For theme files"
echo -e "    • ${GREEN}wp-content/plugins/${NC} - For plugin files"
echo ""
echo -e "${YELLOW}💡 You can now:${NC}"
echo -e "   ✅ Upload themes from WordPress admin"
echo -e "   ✅ Upload plugins from WordPress admin"
echo -e "   ✅ Upload media files (images, videos, etc.)"
echo -e "   ✅ Update WordPress core, themes, and plugins"
echo -e "   ✅ Install new themes and plugins"
echo ""
echo -e "${BLUE}════════════════════════════════════════════════════${NC}"
echo -e "${GREEN}✨ Permission fix completed successfully!${NC}"
echo -e "${BLUE}════════════════════════════════════════════════════${NC}"
echo ""
echo -e "${YELLOW}💡 Tip:${NC} If you still encounter permission issues:"
echo -e "   1. Restart the WordPress container: ${BLUE}docker restart ${WP_CONTAINER}${NC}"
echo -e "   2. Clear your browser cache"
echo -e "   3. Run this script again"
echo ""

