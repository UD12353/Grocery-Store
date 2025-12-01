# 🚀 How to Run PHP Files in VS Code

## ❌ Why Direct Run Doesn't Work

PHP files **cannot** be opened directly in a browser like HTML files. They need a **web server** to process the PHP code.

**Wrong:** `file:///E:/CLG_Fun_Projects/Project/grocery%20store/grocery%20store/login.php` ❌
**Right:** `http://localhost:8000/login.php` ✅

---

## ✅ Solution 1: Quick Start (Terminal Method)

### Step 1: Open Terminal in VS Code

- Press **Ctrl + `** (backtick key)
- Or: Menu → **View** → **Terminal**

### Step 2: Start PHP Server

```powershell
php -S localhost:8000
```

### Step 3: Open in Browser

- **Login Page**: http://localhost:8000/login.php
- **Home Page**: http://localhost:8000/home.php
- **Admin Page**: http://localhost:8000/admin_page.php

### Step 4: Keep Terminal Running

- **Don't close the terminal** while developing
- Press **Ctrl + C** to stop the server when done

---

## ✅ Solution 2: Using PHP Server Extension (One-Click Run)

### Step 1: Install Extension

1. **Open Extensions** in VS Code:

   - Press **Ctrl + Shift + X**
   - Or click Extensions icon in sidebar

2. **Search for**: `PHP Server`
   - By: **brapifra**
   - Click **Install**

### Step 2: Run Your PHP File

1. **Open any PHP file** (e.g., `login.php`)

2. **Right-click** in the editor

3. **Select**: `PHP Server: Serve project`

4. **Browser will open automatically** with your page!

### Step 3: Stop Server

- Right-click → `PHP Server: Stop server`

---

## ✅ Solution 3: Using XAMPP Apache

### Step 1: Start XAMPP

1. Open **XAMPP Control Panel**
2. Click **Start** next to **Apache**
3. Click **Start** next to **MySQL**

### Step 2: Access Your Project

**Option A: Create Symbolic Link** (Recommended)

```powershell
# Run as Administrator
New-Item -ItemType SymbolicLink -Path "C:\xampp\htdocs\grocery-store" -Target "E:\CLG_Fun_Projects\Project\grocery store\grocery store"
```

Then access: **http://localhost/grocery-store/login.php**

**Option B: Copy Project to htdocs**

```powershell
Copy-Item -Path "E:\CLG_Fun_Projects\Project\grocery store\grocery store\*" -Destination "C:\xampp\htdocs\grocery-store" -Recurse
```

Then access: **http://localhost/grocery-store/login.php**

---

## 🎯 Recommended Workflow

### For Daily Development:

1. **Open VS Code**
2. **Open Terminal** (Ctrl + `)
3. **Run**:
   ```powershell
   php -S localhost:8000
   ```
4. **Open browser**: http://localhost:8000/home.php
5. **Edit files** in VS Code
6. **Refresh browser** (F5) to see changes
7. **Stop server** when done (Ctrl + C)

---

## 🔧 VS Code Configuration (Already Set Up!)

I've created these files for you:

### `.vscode/settings.json`

- Configures PHP path
- Sets up PHP server defaults

### `.vscode/launch.json`

- Allows running PHP with F5
- Auto-opens browser

### `.vscode/extensions.json`

- Recommends useful PHP extensions

---

## 📝 Common URLs for Your Project

| Page           | URL                                  |
| -------------- | ------------------------------------ |
| **Home**       | http://localhost:8000/home.php       |
| **Login**      | http://localhost:8000/login.php      |
| **Register**   | http://localhost:8000/register.php   |
| **Shop**       | http://localhost:8000/shop.php       |
| **Cart**       | http://localhost:8000/cart.php       |
| **Admin**      | http://localhost:8000/admin_page.php |
| **Test Setup** | http://localhost:8000/test_setup.php |

---

## 🐛 Troubleshooting

### Error: "php is not recognized"

**Solution:**

1. Restart your computer (if you just ran the setup script)
2. Or use full path:
   ```powershell
   C:\xampp\php\php.exe -S localhost:8000
   ```

### Error: "Port 8000 already in use"

**Solution:**

1. Use a different port:
   ```powershell
   php -S localhost:3000
   ```
2. Or find and kill the process:
   ```powershell
   netstat -ano | findstr :8000
   taskkill /PID <PID> /F
   ```

### Error: "Database connection failed"

**Solution:**

1. Start MySQL in XAMPP Control Panel
2. Check database exists in phpMyAdmin
3. Verify credentials in `project_config.php`

### Page shows PHP code instead of running

**Solution:**

- You're opening the file directly (file://)
- Use http://localhost:8000/ instead

---

## 🎨 VS Code Extensions (Recommended)

Install these for better PHP development:

1. **PHP Server** (brapifra)

   - One-click server start
   - Auto browser refresh

2. **PHP Intelephense** (bmewburn)

   - Code completion
   - Error detection
   - Go to definition

3. **PHP Debug** (xdebug)
   - Debugging support
   - Breakpoints

**To install:**

- Press **Ctrl + Shift + X**
- Search for extension name
- Click **Install**

---

## 🚀 Quick Commands Reference

```powershell
# Start PHP server
php -S localhost:8000

# Start on different port
php -S localhost:3000

# Check PHP version
php --version

# Test PHP
php -r "echo 'PHP works!';"

# Run a PHP file directly (no browser)
php login.php
```

---

## ✅ Your Next Steps

1. **Open Terminal in VS Code** (Ctrl + `)
2. **Run**: `php -S localhost:8000`
3. **Open browser**: http://localhost:3000/home.php
4. **Start coding!**

---

**Created:** 2025-11-26
**Project:** Grocery Store
**PHP Version:** 8.2.12 (XAMPP)
