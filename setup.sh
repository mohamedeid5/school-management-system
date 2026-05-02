#!/bin/bash

set -e

GREEN='\033[0;32m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo -e "${BLUE}🚀 Starting School Management System Setup...${NC}\n"

if [ ! -f .env ]; then
    echo -e "${BLUE}📄 Creating .env file...${NC}"
    cp .env.example .env
else
    echo -e "${GREEN}✅ .env file already exists.${NC}"
fi

echo -e "${BLUE}🐳 Building and starting Docker containers...${NC}"
docker compose up -d --build

echo -e "${BLUE}📦 Installing Composer dependencies...${NC}"
docker compose exec app composer install

echo -e "${BLUE}🔑 Generating application key...${NC}"
docker compose cp .env app:/var/www/html/.env
docker compose exec app php artisan key:generate

echo -e "${BLUE}🗄️ Running migrations and seeders cleanly...${NC}"
docker compose exec app php artisan migrate:fresh --seed

echo -e "\n${GREEN}🎉 Setup Completed Successfully!${NC}"
echo -e "${GREEN}🌍 You can now access the app at: http://localhost:8000${NC}"
