# 🔧 TROUBLESHOOTING GUIDE - DATABASE CONNECTION

## Error: "Database Connection Failed"

### **Quick Fix:**

1. **Start MySQL in XAMPP:**

   - Open XAMPP Control Panel
   - Click "Start" next to MySQL
   - Wait for it to turn green

2. **If MySQL won't start:**
   - Port 3306 might be in use
   - Another MySQL instance might be running
   - Check XAMPP error log

---

## **Step-by-Step Fix:**

### Option 1: Start XAMPP MySQL

```powershell
# Open XAMPP Control Panel
Start-Process "C:\xampp\xampp-control.exe"
```

Then:

1. Click **Start** next to MySQL
2. Wait 5-10 seconds
3. Should show "Running" with green background

---

### Option 2: Check if MySQL is Running

```powershell
# Check MySQL process
Get-Process mysqld -ErrorAction SilentlyContinue
```

If nothing shows up, MySQL is not running.

---

### Option 3: Kill Conflicting Process

If MySQL won't start (port conflict):

```powershell
# Find what's using port 3306
netstat -ano | findstr :3306

# Kill the process (replace XXXX with PID from above)
taskkill /PID XXXX /F
```

Then try starting MySQL again.

---

### Option 4: Check Database Settings

Open **config.php** and verify:

```php
$db_name = 'mysql:host=localhost;dbname=shop_db';
$username = 'root';
$password = '';  // Usually empty for XAMPP
```

---

### Option 5: Create Database

If database doesn't exist:

1. Open: http://localhost/phpmyadmin
2. Click "New" in left sidebar
3. Database name: `shop_db`
4. Click "Create"
5. Import `shop_db.sql` file

---

## **Test Connection:**

Create a test file:

```php
<?php
try {
    $conn = new PDO('mysql:host=localhost;dbname=shop_db', 'root', '');
    echo "✅ Database connection successful!";
} catch(PDOException $e) {
    echo "❌ Connection failed: " . $e->getMessage();
}
?>
```

Save as `test_db.php` and open: http://localhost:8000/test_db.php

---

## **Common Issues:**

### Issue 1: Port 3306 in Use

**Solution:** Stop other MySQL services or change XAMPP MySQL port

### Issue 2: Database Doesn't Exist

**Solution:** Create `shop_db` database in phpMyAdmin

### Issue 3: Wrong Password

**Solution:** Change password in config.php to match MySQL password

### Issue 4: MySQL Service Won't Start

**Solution:** Check XAMPP error log in C:\xampp\mysql\data\mysql_error.log

---

## **Quick Commands:**

```powershell
# Start XAMPP
Start-Process "C:\xampp\xampp-control.exe"

# Check MySQL process
Get-Process mysqld

# Check port 3306
netstat -ano | findstr :3306

# Test PHP server
php -S localhost:8000
```

---

## **URLs to Use:**

- ✅ **Homepage:** http://localhost:8000/home.php
- ✅ **Admin:** http://localhost:8000/admin_dashboard.php
- ✅ **phpMyAdmin:** http://localhost/phpmyadmin
- ✅ **Root:** http://localhost:8000 (now redirects to home)

---

**After MySQL starts, refresh your browser and the site should work!** 🎉
