# StarVista local launcher (XAMPP PHP + MariaDB on port 3307)
$ErrorActionPreference = "Stop"
$root = Split-Path -Parent $PSScriptRoot
if (-not (Test-Path (Join-Path $root "wp-config.php"))) {
  $root = $PSScriptRoot
  if (-not (Test-Path (Join-Path $root "wp-config.php"))) {
    $root = "C:\Users\visha\OneDrive\Desktop\X1_Race Assignment"
  }
}
Set-Location $root
Write-Host "Starting StarVista at http://127.0.0.1:8080"
& "C:\xampp\php\php.exe" -S 127.0.0.1:8080 router.php
