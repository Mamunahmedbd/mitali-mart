#!/bin/bash

#####################################################################
# MariaDB Database Setup Script
# Description: Creates database, user, and sets proper permissions
# Author: Professional Database Setup
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
echo -e "${BLUE}║   MariaDB Database Setup - Docker Environment     ║${NC}"
echo -e "${BLUE}╔════════════════════════════════════════════════════╗${NC}"
echo ""

# Function to validate input
validate_input() {
    if [ -z "$1" ]; then
        echo -e "${RED}Error: Input cannot be empty!${NC}"
        return 1
    fi
    return 0
}

# Function to validate database name (alphanumeric and underscore only)
validate_db_name() {
    if [[ ! "$1" =~ ^[a-zA-Z0-9_]+$ ]]; then
        echo -e "${RED}Error: Database name can only contain letters, numbers, and underscores!${NC}"
        return 1
    fi
    return 0
}

# Function to validate username (alphanumeric and underscore only)
validate_username() {
    if [[ ! "$1" =~ ^[a-zA-Z0-9_]+$ ]]; then
        echo -e "${RED}Error: Username can only contain letters, numbers, and underscores!${NC}"
        return 1
    fi
    if [ ${#1} -gt 32 ]; then
        echo -e "${RED}Error: Username cannot exceed 32 characters!${NC}"
        return 1
    fi
    return 0
}

# Function to validate password strength
validate_password() {
    if [ ${#1} -lt 8 ]; then
        echo -e "${YELLOW}Warning: Password should be at least 8 characters for security!${NC}"
        read -p "Continue anyway? (y/n): " continue_weak
        if [ "$continue_weak" != "y" ]; then
            return 1
        fi
    fi
    return 0
}

# Check if Docker is running
if ! docker ps > /dev/null 2>&1; then
    echo -e "${RED}Error: Docker is not running or you don't have permission to access it!${NC}"
    echo -e "${YELLOW}Please start Docker or run this script with appropriate permissions.${NC}"
    exit 1
fi

# Detect MariaDB container
echo -e "${BLUE}🔍 Detecting MariaDB container...${NC}"
MARIADB_CONTAINER=$(docker ps --format '{{.Names}}' | grep -i 'mariadb\|mysql\|db' | head -n 1)

if [ -z "$MARIADB_CONTAINER" ]; then
    echo -e "${RED}Error: No MariaDB/MySQL container found!${NC}"
    echo -e "${YELLOW}Available containers:${NC}"
    docker ps --format "table {{.Names}}\t{{.Image}}"
    echo ""
    read -p "Enter the exact container name: " MARIADB_CONTAINER

    if [ -z "$MARIADB_CONTAINER" ]; then
        echo -e "${RED}Error: Container name cannot be empty!${NC}"
        exit 1
    fi
fi

echo -e "${GREEN}✓ Found container: ${MARIADB_CONTAINER}${NC}"
echo ""

# Get root password
echo -e "${YELLOW}📋 Database Configuration${NC}"
echo -e "${YELLOW}─────────────────────────────────────────────────────${NC}"

# Try to read root password from .env file if it exists
if [ -f ".env" ]; then
    ROOT_PASS=$(grep "MYSQL_ROOT_PASSWORD" .env | cut -d '=' -f2)
    if [ -n "$ROOT_PASS" ]; then
        echo -e "${GREEN}✓ Root password found in .env file${NC}"
    fi
fi

# If not found, prompt for it
if [ -z "$ROOT_PASS" ]; then
    read -sp "Enter MariaDB root password: " ROOT_PASS
    echo ""
    if ! validate_input "$ROOT_PASS"; then
        exit 1
    fi
fi

# Test database connection
echo -e "${BLUE}🔌 Testing database connection...${NC}"
if ! docker exec -i "$MARIADB_CONTAINER" mariadb -uroot -p"$ROOT_PASS" -e "SELECT 1;" > /dev/null 2>&1; then
    echo -e "${RED}Error: Unable to connect to MariaDB with provided root password!${NC}"
    exit 1
fi
echo -e "${GREEN}✓ Connection successful!${NC}"
echo ""

# Prompt for database name
while true; do
    read -p "Enter database name: " DB_NAME
    if validate_input "$DB_NAME" && validate_db_name "$DB_NAME"; then
        break
    fi
done

# Prompt for username
while true; do
    read -p "Enter database username: " DB_USER
    if validate_input "$DB_USER" && validate_username "$DB_USER"; then
        break
    fi
done

# Prompt for password
while true; do
    read -sp "Enter database password: " DB_PASS
    echo ""
    if validate_input "$DB_PASS" && validate_password "$DB_PASS"; then
        read -sp "Confirm password: " DB_PASS_CONFIRM
        echo ""
        if [ "$DB_PASS" == "$DB_PASS_CONFIRM" ]; then
            break
        else
            echo -e "${RED}Error: Passwords do not match!${NC}"
        fi
    fi
done

# Prompt for host permission (localhost vs any host)
echo ""
echo -e "${YELLOW}Host Access Configuration:${NC}"
echo "1. localhost only (more secure)"
echo "2. Any host '%' (less secure, use for Docker networks)"
read -p "Select option (1-2) [default: 2]: " HOST_OPTION

case $HOST_OPTION in
    1)
        DB_HOST="localhost"
        ;;
    *)
        DB_HOST="%"
        ;;
esac

# Summary
echo ""
echo -e "${BLUE}═══════════════════════════════════════════════════${NC}"
echo -e "${YELLOW}Configuration Summary:${NC}"
echo -e "${BLUE}═══════════════════════════════════════════════════${NC}"
echo -e "Container:    ${GREEN}${MARIADB_CONTAINER}${NC}"
echo -e "Database:     ${GREEN}${DB_NAME}${NC}"
echo -e "Username:     ${GREEN}${DB_USER}${NC}"
echo -e "Host Access:  ${GREEN}${DB_HOST}${NC}"
echo -e "${BLUE}═══════════════════════════════════════════════════${NC}"
echo ""

read -p "Proceed with database creation? (y/n): " CONFIRM

if [ "$CONFIRM" != "y" ]; then
    echo -e "${YELLOW}Operation cancelled.${NC}"
    exit 0
fi

echo ""
echo -e "${BLUE}🚀 Creating database and user...${NC}"

# Create SQL commands
SQL_COMMANDS="
-- Create database
CREATE DATABASE IF NOT EXISTS \`${DB_NAME}\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Create user (if not exists)
CREATE USER IF NOT EXISTS '${DB_USER}'@'${DB_HOST}' IDENTIFIED BY '${DB_PASS}';

-- Grant privileges
GRANT ALL PRIVILEGES ON \`${DB_NAME}\`.* TO '${DB_USER}'@'${DB_HOST}';

-- Additional recommended privileges for full database management
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, INDEX, ALTER,
      CREATE TEMPORARY TABLES, LOCK TABLES, EXECUTE, CREATE VIEW,
      SHOW VIEW, CREATE ROUTINE, ALTER ROUTINE, EVENT, TRIGGER
      ON \`${DB_NAME}\`.* TO '${DB_USER}'@'${DB_HOST}';

-- Flush privileges to apply changes
FLUSH PRIVILEGES;

-- Show created database
SHOW DATABASES LIKE '${DB_NAME}';
"

# Execute SQL commands
if docker exec -i "$MARIADB_CONTAINER" mariadb -uroot -p"$ROOT_PASS" <<< "$SQL_COMMANDS" > /dev/null 2>&1; then
    echo -e "${GREEN}✓ Database created successfully!${NC}"
    echo -e "${GREEN}✓ User created successfully!${NC}"
    echo -e "${GREEN}✓ Permissions granted successfully!${NC}"
    echo ""

    # Verify database creation
    echo -e "${BLUE}🔍 Verifying setup...${NC}"
    docker exec -i "$MARIADB_CONTAINER" mariadb -uroot -p"$ROOT_PASS" -e "
        SELECT
            SCHEMA_NAME as 'Database',
            DEFAULT_CHARACTER_SET_NAME as 'Charset',
            DEFAULT_COLLATION_NAME as 'Collation'
        FROM information_schema.SCHEMATA
        WHERE SCHEMA_NAME = '${DB_NAME}';
    "

    echo ""
    echo -e "${GREEN}═══════════════════════════════════════════════════${NC}"
    echo -e "${GREEN}✓ Database setup completed successfully!${NC}"
    echo -e "${GREEN}═══════════════════════════════════════════════════${NC}"
    echo ""
    echo -e "${YELLOW}📝 Connection Details:${NC}"
    echo -e "   Host:     ${GREEN}${MARIADB_CONTAINER}${NC} or ${GREEN}localhost:3306${NC}"
    echo -e "   Database: ${GREEN}${DB_NAME}${NC}"
    echo -e "   Username: ${GREEN}${DB_USER}${NC}"
    echo -e "   Password: ${GREEN}[HIDDEN]${NC}"
    echo ""
    echo -e "${YELLOW}💡 Test connection:${NC}"
    echo -e "   ${BLUE}docker exec -it ${MARIADB_CONTAINER} mariadb -u${DB_USER} -p ${DB_NAME}${NC}"
    echo ""

    # Optional: Save to .env if requested
    read -p "Save configuration to .env file? (y/n): " SAVE_ENV
    if [ "$SAVE_ENV" == "y" ]; then
        echo "" >> .env
        echo "# Database Configuration - Generated $(date)" >> .env
        echo "MYSQL_DATABASE=${DB_NAME}" >> .env
        echo "MYSQL_USER=${DB_USER}" >> .env
        echo "MYSQL_PASSWORD=${DB_PASS}" >> .env
        echo "MYSQL_HOST=${MARIADB_CONTAINER}" >> .env
        echo "MYSQL_PORT=3306" >> .env
        echo -e "${GREEN}✓ Configuration saved to .env file${NC}"
    fi

else
    echo -e "${RED}✗ Error creating database!${NC}"
    echo -e "${YELLOW}Please check the error messages above.${NC}"
    exit 1
fi

echo ""
echo -e "${BLUE}════════════════════════════════════════════════════${NC}"
echo -e "${GREEN}🎉 All done! Your database is ready to use.${NC}"
echo -e "${BLUE}════════════════════════════════════════════════════${NC}"

