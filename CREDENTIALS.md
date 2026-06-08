# 🔐 Foosto - Test User Credentials

## Default Password for All Users
**Password:** `password`

---

## 👨‍💼 Admin Account

**Email:** `admin@foosto.com`  
**Password:** `password`  
**Dashboard:** `/admin/dashboard`

**Permissions:**
- Manage all merchants
- Manage all riders
- Manage all customers
- View all orders
- Manage commissions
- System settings
- Activity logs

---

## 🏍️ Rider Accounts

### Rider 1 (Primary Test Account)
**Email:** `rider@foosto.com`  
**Password:** `password`  
**Name:** Karim Rahman  
**Phone:** 01711111111  
**Vehicle:** Motorcycle (DHA-1234)  
**Status:** Idle (Ready for orders)  
**Balance:** ৳500.00  
**Dashboard:** `/rider/dashboard`

### Rider 2
**Email:** `rider2@foosto.com`  
**Password:** `password`  
**Name:** Rahim Mia  
**Phone:** 01722222222  
**Vehicle:** Bicycle  
**Status:** Offline  
**Balance:** ৳1,200.00  
**Dashboard:** `/rider/dashboard`

### Rider 3
**Email:** `rider3@foosto.com`  
**Password:** `password`  
**Name:** Sabbir Hossain  
**Phone:** 01733333333  
**Vehicle:** Motorcycle (DHA-5678)  
**Status:** Idle (Ready for orders)  
**Balance:** ৳750.00  
**Dashboard:** `/rider/dashboard`

---

## 🏪 Merchant Accounts

Check `database/seeders/MerchantSeeder.php` for merchant accounts.

---

## 👥 Customer Accounts

Customers are created when they register on the platform.

---

## 🚀 Quick Login Guide

### To Access Rider Dashboard:

1. **Go to:** `http://127.0.0.1:8000/login`
2. **Enter credentials:**
   - Email: `rider@foosto.com`
   - Password: `password`
3. **After login:**
   - You'll be redirected to `/dashboard`
   - Laravel will detect you're a rider
   - Auto-redirect to `/rider/dashboard`

### Alternative Direct Access:
After logging in, you can directly visit: `http://127.0.0.1:8000/rider/dashboard`

---

## 🔒 Role-Based Access Control

The system uses role-based middleware:

- **Admin Middleware:** Checks `isAdmin()` method
- **Merchant Middleware:** Checks `isMerchant()` method
- **Rider Middleware:** Checks `isRider()` method
- **Customer:** Default role, no special middleware

### Access Flow:
```
Login → /dashboard → Auto-redirect based on role:
├── Admin → /admin/dashboard
├── Merchant → /merchant/dashboard
├── Rider → /rider/dashboard
└── Customer → /my/orders
```

---

## 🛠️ Troubleshooting

### Issue: "Redirected to home when accessing /rider/dashboard"

**Possible causes:**
1. Not logged in
2. Logged in with wrong role (admin/merchant/customer)
3. Rider record missing in database

**Solution:**
1. Logout: `http://127.0.0.1:8000/logout`
2. Login with rider credentials: `rider@foosto.com` / `password`
3. Visit: `http://127.0.0.1:8000/rider/dashboard`

### Issue: "Rider profile not found"

**Cause:** User has rider role but no entry in `riders` table

**Solution:**
```bash
php artisan db:seed --class=RiderSeeder
```

### Issue: "You do not have permission"

**Cause:** Logged in with different role (admin, merchant, or customer)

**Solution:**
1. Logout first
2. Login with correct rider credentials

---

## 📊 Database Role Structure

```sql
-- Roles Table
+----+----------+----------+
| id | name     | slug     |
+----+----------+----------+
| 1  | Admin    | admin    |
| 2  | Merchant | merchant |
| 3  | Rider    | rider    |
| 4  | Customer | customer |
+----+----------+----------+

-- Users Table (riders)
+----+-----------------+---------------------+---------+
| id | name            | email               | role_id |
+----+-----------------+---------------------+---------+
| 2  | Karim Rahman    | rider@foosto.com    | 3       |
| 3  | Rahim Mia       | rider2@foosto.com   | 3       |
| 4  | Sabbir Hossain  | rider3@foosto.com   | 3       |
+----+-----------------+---------------------+---------+

-- Riders Table
+----+---------+--------------+-----------------+--------+
| id | user_id | vehicle_type | vehicle_number  | status |
+----+---------+--------------+-----------------+--------+
| 1  | 2       | Motorcycle   | DHA-1234        | idle   |
| 2  | 3       | Bicycle      | N/A             | offline|
| 3  | 4       | Motorcycle   | DHA-5678        | idle   |
+----+---------+--------------+-----------------+--------+
```

---

## 🎯 Testing Checklist

- [ ] Login as rider: `rider@foosto.com` / `password`
- [ ] Access `/rider/dashboard` - Should show dashboard
- [ ] View earnings cards with ৳ amounts
- [ ] Toggle Online/Offline status
- [ ] View order tabs (Assigned, Accepted, etc.)
- [ ] Check earnings page: `/rider/earnings`
- [ ] Verify dark mode toggle works
- [ ] Test mobile responsive view
- [ ] Logout and login again
- [ ] Try accessing `/admin/dashboard` (should be denied)

---

## 🔄 Reset Database

If you need to start fresh:

```bash
php artisan migrate:fresh --seed
```

This will:
1. Drop all tables
2. Run all migrations
3. Seed admin user
4. Seed merchants
5. Seed riders (3 accounts)
6. Seed orders

---

## 📝 Notes

- All passwords are bcrypt hashed
- Rider status: `idle` = online and ready, `offline` = not accepting orders, `busy` = currently delivering
- Application status must be `approved` for riders to access dashboard
- Balance is tracked in `riders.current_balance` field

---

## 🆘 Support

If issues persist:
1. Clear all caches: `php artisan optimize:clear`
2. Check logs: `storage/logs/laravel.log`
3. Verify database connection in `.env`
4. Ensure migrations are run: `php artisan migrate:status`

---

**Last Updated:** June 8, 2026  
**Version:** 1.0.0
