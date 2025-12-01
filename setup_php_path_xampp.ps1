# PowerShell Script to Add XAMPP PHP to System PATH
# Run this script as Administrator

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "   XAMPP PHP PATH Setup Script" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Define XAMPP PHP path
$xamppPhpPath = "C:\xampp\php"

# Check if XAMPP PHP exists
if (Test-Path "$xamppPhpPath\php.exe") {
    Write-Host "✓ XAMPP PHP found at: $xamppPhpPath" -ForegroundColor Green
    
    # Get current system PATH
    $currentPath = [Environment]::GetEnvironmentVariable("Path", "Machine")
    
    # Check if PHP is already in PATH
    if ($currentPath -like "*$xamppPhpPath*") {
        Write-Host "✓ XAMPP PHP is already in system PATH" -ForegroundColor Yellow
        Write-Host ""
        Write-Host "If 'php' command is not working, please:" -ForegroundColor Yellow
        Write-Host "  1. Close ALL PowerShell/Terminal windows" -ForegroundColor Yellow
        Write-Host "  2. Restart your computer (RECOMMENDED)" -ForegroundColor Yellow
        Write-Host "  3. Open a NEW terminal and try: php --version" -ForegroundColor Yellow
    }
    else {
        Write-Host "Adding XAMPP PHP to system PATH..." -ForegroundColor Yellow
        
        try {
            # Add PHP to PATH
            $newPath = $currentPath + ";" + $xamppPhpPath
            [Environment]::SetEnvironmentVariable("Path", $newPath, "Machine")
            
            Write-Host "✓ XAMPP PHP has been added to system PATH!" -ForegroundColor Green
            Write-Host ""
            Write-Host "========================================" -ForegroundColor Green
            Write-Host "   IMPORTANT: RESTART YOUR COMPUTER" -ForegroundColor Green
            Write-Host "========================================" -ForegroundColor Green
            Write-Host ""
            Write-Host "After restarting, open PowerShell and run:" -ForegroundColor Cyan
            Write-Host "  php --version" -ForegroundColor White
            Write-Host ""
        }
        catch {
            Write-Host "✗ Error: Failed to update PATH" -ForegroundColor Red
            Write-Host "  Error message: $($_.Exception.Message)" -ForegroundColor Red
            Write-Host ""
            Write-Host "Please run this script as Administrator:" -ForegroundColor Yellow
            Write-Host "  1. Right-click PowerShell" -ForegroundColor Yellow
            Write-Host "  2. Select 'Run as Administrator'" -ForegroundColor Yellow
            Write-Host "  3. Run this script again" -ForegroundColor Yellow
        }
    }
    
    # Show PHP version
    Write-Host ""
    Write-Host "========================================" -ForegroundColor Cyan
    Write-Host "   PHP Information" -ForegroundColor Cyan
    Write-Host "========================================" -ForegroundColor Cyan
    & "$xamppPhpPath\php.exe" --version
    Write-Host ""
    
    # Show PHP configuration file location
    Write-Host "PHP Configuration File (php.ini):" -ForegroundColor Cyan
    if (Test-Path "$xamppPhpPath\php.ini") {
        Write-Host "  ✓ Found: $xamppPhpPath\php.ini" -ForegroundColor Green
    }
    else {
        Write-Host "  ! Not found. You may need to copy php.ini-development to php.ini" -ForegroundColor Yellow
        Write-Host "    Location: $xamppPhpPath" -ForegroundColor Yellow
    }
    
}
else {
    Write-Host "✗ XAMPP PHP not found at: $xamppPhpPath" -ForegroundColor Red
    Write-Host ""
    Write-Host "Please check:" -ForegroundColor Yellow
    Write-Host "  1. Is XAMPP installed?" -ForegroundColor Yellow
    Write-Host "  2. Is it installed at C:\xampp?" -ForegroundColor Yellow
    Write-Host "  3. If installed elsewhere, update the path in this script" -ForegroundColor Yellow
    Write-Host ""
    Write-Host "To install XAMPP:" -ForegroundColor Cyan
    Write-Host "  1. Download from: https://www.apachefriends.org/" -ForegroundColor White
    Write-Host "  2. Install to C:\xampp (recommended)" -ForegroundColor White
    Write-Host "  3. Run this script again" -ForegroundColor White
}

Write-Host ""
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "   Setup Complete" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Pause to let user read the output
Read-Host "Press Enter to exit"
