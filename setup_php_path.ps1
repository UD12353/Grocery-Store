# PowerShell Script to Add PHP to System PATH
# Run this script as Administrator

Write-Host "=== PHP PATH Setup Script ===" -ForegroundColor Cyan
Write-Host ""

# Define PHP path
$phpPath = "C:\Program Files\php-8.5.0"

# Check if PHP exists
if (Test-Path "$phpPath\php.exe") {
    Write-Host "✓ PHP found at: $phpPath" -ForegroundColor Green
    
    # Get current system PATH
    $currentPath = [Environment]::GetEnvironmentVariable("Path", "Machine")
    
    # Check if PHP is already in PATH
    if ($currentPath -like "*$phpPath*") {
        Write-Host "✓ PHP is already in system PATH" -ForegroundColor Yellow
        Write-Host ""
        Write-Host "If 'php' command is not working, please:" -ForegroundColor Yellow
        Write-Host "1. Close and reopen PowerShell/Terminal" -ForegroundColor Yellow
        Write-Host "2. Or restart your computer" -ForegroundColor Yellow
    } else {
        Write-Host "Adding PHP to system PATH..." -ForegroundColor Yellow
        
        # Add PHP to PATH
        $newPath = $currentPath + ";" + $phpPath
        [Environment]::SetEnvironmentVariable("Path", $newPath, "Machine")
        
        Write-Host "✓ PHP has been added to system PATH!" -ForegroundColor Green
        Write-Host ""
        Write-Host "IMPORTANT: Please restart your computer or close all terminals for changes to take effect." -ForegroundColor Cyan
    }
    
    # Show PHP version
    Write-Host ""
    Write-Host "PHP Version:" -ForegroundColor Cyan
    & "$phpPath\php.exe" --version
    
} else {
    Write-Host "✗ PHP not found at: $phpPath" -ForegroundColor Red
    Write-Host "Please verify your PHP installation path." -ForegroundColor Red
}

Write-Host ""
Write-Host "=== Setup Complete ===" -ForegroundColor Cyan
