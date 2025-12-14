╔════════════════════════════════════════════════════════════════════════════╗
║              PHPMYADMIN SECURITY CONFIGURATION                             ║
║                    ✅ BASICAUTH PROTECTION ENABLED                          ║
╚════════════════════════════════════════════════════════════════════════════╝

Date Configured: December 14, 2025
Security Status: ✅ PROTECTED

═══════════════════════════════════════════════════════════════════════════════

🔐 DEFAULT CREDENTIALS
───────────────────────────────────────────────────────────────────────────────

PHPMyAdmin URL: https://pma.mitalimart.com

⚠️  TWO-LAYER AUTHENTICATION:

Layer 1 - BasicAuth (Browser Popup):
  Username: admin
  Password: changeme123

Layer 2 - PHPMyAdmin Login:
  Username: (Your database user from .env)
  Password: (Your database password from .env)

═══════════════════════════════════════════════════════════════════════════════

🚨 IMPORTANT: CHANGE DEFAULT PASSWORD IMMEDIATELY!
───────────────────────────────────────────────────────────────────────────────

⚠️  The default password "changeme123" is publicly documented.
⚠️  You MUST change it to a strong, unique password!

═══════════════════════════════════════════════════════════════════════════════

🔧 HOW TO CHANGE THE PASSWORD
───────────────────────────────────────────────────────────────────────────────

METHOD 1: Use the Password Generator Script (Recommended)
──────────────────────────────────────────────────────────

1. Run the password generator:
   $ cd /var/www/mitali-mart
   $ ./generate-phpmyadmin-password.sh

2. Follow the prompts to create a new username/password

3. Copy the generated label line

4. Update docker-compose.yaml:
   - Find the line with "pma-auth.basicauth.users"
   - Replace it with the new generated line

5. Restart PHPMyAdmin:
   $ docker compose up -d phpmyadmin


METHOD 2: Manual Password Generation
─────────────────────────────────────

1. Generate password hash:
   $ echo $(htpasswd -nB yourusername) | sed -e s/\\$/\\$\\$/g

   (You'll be prompted to enter your password)

2. Update docker-compose.yaml:
   Replace this line:
   - "traefik.http.middlewares.pma-auth.basicauth.users=admin:$$2y$$05$$..."

   With your new hash:
   - "traefik.http.middlewares.pma-auth.basicauth.users=yourusername:$$2y$$05$$NEWHASH"

3. Restart PHPMyAdmin:
   $ docker compose up -d phpmyadmin


METHOD 3: Using OpenSSL (if htpasswd not available)
────────────────────────────────────────────────────

1. Generate password hash:
   $ PASSWORD_HASH=$(openssl passwd -apr1)
   (Enter your password when prompted)

2. Escape dollar signs:
   $ echo "yourusername:$PASSWORD_HASH" | sed 's/\$/\$\$/g'

3. Update docker-compose.yaml and restart as above

═══════════════════════════════════════════════════════════════════════════════

🛡️ ADDITIONAL SECURITY RECOMMENDATIONS
───────────────────────────────────────────────────────────────────────────────

✅ COMPLETED:
  ✓ BasicAuth protection enabled (2-factor: browser + PHPMyAdmin)
  ✓ HTTPS/TLS encryption via Cloudflare
  ✓ Traefik reverse proxy configuration
  ✓ Custom realm message for authentication

🔒 RECOMMENDED (Optional but Strongly Advised):

1. IP WHITELISTING
   Restrict access to specific IP addresses only:

   Add to docker-compose.yaml under pma labels:
   - "traefik.http.middlewares.pma-ipwhitelist.ipwhitelist.sourcerange=YOUR_IP/32,YOUR_OFFICE_IP/32"
   - "traefik.http.routers.pma-mitalimart.middlewares=pma-auth@docker,pma-ipwhitelist@docker"

   Replace YOUR_IP with your actual IP address

2. RATE LIMITING
   Prevent brute force attacks:

   Add to docker-compose.yaml:
   - "traefik.http.middlewares.pma-ratelimit.ratelimit.average=5"
   - "traefik.http.middlewares.pma-ratelimit.ratelimit.burst=10"
   - "traefik.http.routers.pma-mitalimart.middlewares=pma-auth@docker,pma-ratelimit@docker"

3. VPN ACCESS ONLY
   Consider accessing PHPMyAdmin only through VPN:
   - Set up WireGuard or OpenVPN
   - Remove public PHPMyAdmin exposure
   - Access only via private network

4. DISABLE WHEN NOT NEEDED
   Stop PHPMyAdmin container when not in use:
   $ docker stop mitalimart-phpmyadmin

   Start when needed:
   $ docker start mitalimart-phpmyadmin

5. MONITORING & ALERTS
   Set up log monitoring for failed authentication attempts:
   $ docker logs -f mitalimart-phpmyadmin | grep -i "auth\|401\|403"

═══════════════════════════════════════════════════════════════════════════════

📊 SECURITY LAYERS OVERVIEW
───────────────────────────────────────────────────────────────────────────────

Layer 1: Cloudflare
  • DDoS protection
  • Bot detection
  • SSL/TLS encryption
  • CDN caching

Layer 2: Traefik BasicAuth ⭐ NEW
  • Username/password prompt (browser popup)
  • Blocks unauthorized access before reaching PHPMyAdmin
  • Failed attempts logged

Layer 3: PHPMyAdmin Login
  • Database credentials required
  • Session management
  • MySQL/MariaDB authentication

Layer 4: Docker Network Isolation
  • Containers on isolated networks
  • Database not directly exposed
  • Internal communication only

═══════════════════════════════════════════════════════════════════════════════

🧪 TESTING THE SECURITY
───────────────────────────────────────────────────────────────────────────────

1. Test BasicAuth is working:
   $ curl -I https://pma.mitalimart.com

   Should return: 401 Unauthorized
   Should include: www-authenticate: Basic realm="..."

2. Test with credentials:
   $ curl -I -u admin:changeme123 https://pma.mitalimart.com

   Should return: 200 OK (after changing to your password)

3. Access via browser:
   - Visit: https://pma.mitalimart.com
   - Browser popup will ask for username/password
   - After entering BasicAuth, you'll see PHPMyAdmin login
   - Enter database credentials to access PHPMyAdmin

═══════════════════════════════════════════════════════════════════════════════

📝 TROUBLESHOOTING
───────────────────────────────────────────────────────────────────────────────

Problem: Still accessing PHPMyAdmin without BasicAuth
Solution:
  • Clear browser cache
  • Verify docker-compose.yaml has the middleware
  • Restart Traefik: docker restart traefik
  • Check Traefik logs: docker logs traefik

Problem: "Invalid credentials" even with correct password
Solution:
  • Verify password hash has escaped $$ (double dollar signs)
  • Regenerate hash using the script
  • Check for typos in docker-compose.yaml

Problem: Can't access PHPMyAdmin at all
Solution:
  • Check container status: docker ps | grep phpmyadmin
  • Check logs: docker logs mitalimart-phpmyadmin
  • Verify DNS is pointing to your server
  • Test without auth temporarily to isolate issue

═══════════════════════════════════════════════════════════════════════════════

📂 RELATED FILES
───────────────────────────────────────────────────────────────────────────────

• docker-compose.yaml - Main configuration with BasicAuth
• generate-phpmyadmin-password.sh - Password generator script
• .env - Database credentials (for PHPMyAdmin login layer 2)

═══════════════════════════════════════════════════════════════════════════════

🔄 MAINTENANCE
───────────────────────────────────────────────────────────────────────────────

Regular Security Tasks:

□ Change BasicAuth password every 90 days
□ Review PHPMyAdmin access logs monthly
□ Update PHPMyAdmin image regularly: docker compose pull phpmyadmin
□ Monitor failed authentication attempts
□ Audit user access and remove unused accounts
□ Review and update IP whitelist as needed

═══════════════════════════════════════════════════════════════════════════════

✅ CURRENT STATUS
───────────────────────────────────────────────────────────────────────────────

✓ BasicAuth enabled and working (HTTP 401 confirmed)
✓ HTTPS encryption active via Cloudflare
✓ Two-layer authentication enforced
✓ Traefik middleware configured
✓ Password generator script available
⚠️ DEFAULT PASSWORD IN USE - CHANGE IMMEDIATELY!

═══════════════════════════════════════════════════════════════════════════════

🎯 IMMEDIATE ACTION REQUIRED
───────────────────────────────────────────────────────────────────────────────

1. RUN THIS NOW:
   $ cd /var/www/mitali-mart
   $ ./generate-phpmyadmin-password.sh

2. Follow the prompts to set a strong password

3. Update docker-compose.yaml with the generated credentials

4. Restart PHPMyAdmin:
   $ docker compose up -d phpmyadmin

5. Test the new credentials at https://pma.mitalimart.com

═══════════════════════════════════════════════════════════════════════════════

For questions or issues, refer to:
  • DEPLOYMENT-SUCCESS.txt - Overall deployment guide
  • ARCHITECTURE-COMPARISON.txt - System architecture
  • Docker logs: docker logs mitalimart-phpmyadmin
  • Traefik logs: docker logs traefik

═══════════════════════════════════════════════════════════════════════════════
Last Updated: December 14, 2025

