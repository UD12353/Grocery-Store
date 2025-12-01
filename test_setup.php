<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation Test - Grocery Store Project</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 800px;
            width: 100%;
            padding: 40px;
        }
        
        h1 {
            color: #667eea;
            margin-bottom: 10px;
            font-size: 2.5em;
            text-align: center;
        }
        
        .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 1.1em;
        }
        
        .test-section {
            margin: 20px 0;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            border-left: 4px solid #667eea;
        }
        
        .test-item {
            display: flex;
            align-items: center;
            padding: 15px;
            margin: 10px 0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .test-icon {
            font-size: 24px;
            margin-right: 15px;
            min-width: 30px;
        }
        
        .success {
            color: #28a745;
        }
        
        .error {
            color: #dc3545;
        }
        
        .warning {
            color: #ffc107;
        }
        
        .test-label {
            flex: 1;
            font-weight: 600;
            color: #333;
        }
        
        .test-value {
            color: #666;
            font-family: 'Courier New', monospace;
            background: #f1f3f5;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.9em;
        }
        
        .section-title {
            font-size: 1.3em;
            color: #667eea;
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        .info-box {
            background: #e7f3ff;
            border-left: 4px solid #2196F3;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
        
        .info-box h3 {
            color: #2196F3;
            margin-bottom: 10px;
        }
        
        .info-box ul {
            margin-left: 20px;
        }
        
        .info-box li {
            margin: 5px 0;
            color: #333;
        }
        
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #e9ecef;
            color: #666;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 25px;
            margin: 10px 5px;
            font-weight: 600;
            transition: transform 0.3s ease;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚀 Installation Test</h1>
        <p class="subtitle">Grocery Store Project - System Verification</p>
        
        <?php
        // Include project configuration
        $configFile = __DIR__ . '/project_config.php';
        $configExists = file_exists($configFile);
        
        if ($configExists) {
            include $configFile;
        }
        
        // Test results array
        $tests = [];
        $allPassed = true;
        
        // Test 1: PHP Version
        $phpVersion = phpversion();
        $tests[] = [
            'label' => 'PHP Version',
            'value' => $phpVersion,
            'status' => version_compare($phpVersion, '7.4.0', '>=') ? 'success' : 'error',
            'message' => version_compare($phpVersion, '7.4.0', '>=') ? 'Compatible' : 'Upgrade needed'
        ];
        
        // Test 2: PHP Extensions
        $requiredExtensions = ['pdo', 'pdo_mysql', 'mysqli', 'mbstring', 'json'];
        $extensionStatus = [];
        foreach ($requiredExtensions as $ext) {
            $loaded = extension_loaded($ext);
            $extensionStatus[$ext] = $loaded;
            if (!$loaded) $allPassed = false;
        }
        
        // Test 3: Project Configuration
        $tests[] = [
            'label' => 'Project Config File',
            'value' => $configExists ? 'Found' : 'Not Found',
            'status' => $configExists ? 'success' : 'error'
        ];
        
        // Test 4: Database Connection
        $dbStatus = 'Not Tested';
        $dbStatusIcon = 'warning';
        if ($configExists && isset($conn)) {
            try {
                $conn->query('SELECT 1');
                $dbStatus = 'Connected';
                $dbStatusIcon = 'success';
            } catch (PDOException $e) {
                $dbStatus = 'Failed: ' . $e->getMessage();
                $dbStatusIcon = 'error';
                $allPassed = false;
            }
        }
        
        // Test 5: File Permissions
        $uploadDir = __DIR__ . '/uploaded_img';
        $uploadDirExists = is_dir($uploadDir);
        $uploadDirWritable = $uploadDirExists && is_writable($uploadDir);
        
        // Test 6: Project Paths
        $projectDrive = strtoupper(substr(__DIR__, 0, 2));
        $phpDrive = strtoupper(substr(PHP_BINARY, 0, 2));
        
        ?>
        
        <!-- PHP Information -->
        <div class="test-section">
            <div class="section-title">📋 PHP Information</div>
            
            <div class="test-item">
                <span class="test-icon success">✓</span>
                <span class="test-label">PHP Version</span>
                <span class="test-value"><?php echo $phpVersion; ?></span>
            </div>
            
            <div class="test-item">
                <span class="test-icon success">✓</span>
                <span class="test-label">PHP Binary</span>
                <span class="test-value"><?php echo PHP_BINARY; ?></span>
            </div>
            
            <div class="test-item">
                <span class="test-icon <?php echo $projectDrive === $phpDrive ? 'success' : 'warning'; ?>">
                    <?php echo $projectDrive === $phpDrive ? '✓' : '⚠'; ?>
                </span>
                <span class="test-label">Drive Configuration</span>
                <span class="test-value">
                    Project: <?php echo $projectDrive; ?> | PHP: <?php echo $phpDrive; ?>
                    <?php echo $projectDrive === $phpDrive ? ' (Same)' : ' (Different - OK)'; ?>
                </span>
            </div>
        </div>
        
        <!-- PHP Extensions -->
        <div class="test-section">
            <div class="section-title">🔌 PHP Extensions</div>
            
            <?php foreach ($requiredExtensions as $ext): ?>
            <div class="test-item">
                <span class="test-icon <?php echo $extensionStatus[$ext] ? 'success' : 'error'; ?>">
                    <?php echo $extensionStatus[$ext] ? '✓' : '✗'; ?>
                </span>
                <span class="test-label"><?php echo strtoupper($ext); ?></span>
                <span class="test-value">
                    <?php echo $extensionStatus[$ext] ? 'Loaded' : 'Not Loaded'; ?>
                </span>
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Database Connection -->
        <div class="test-section">
            <div class="section-title">🗄️ Database Connection</div>
            
            <div class="test-item">
                <span class="test-icon <?php echo $dbStatusIcon; ?>">
                    <?php 
                    echo $dbStatusIcon === 'success' ? '✓' : 
                         ($dbStatusIcon === 'error' ? '✗' : '⚠'); 
                    ?>
                </span>
                <span class="test-label">MySQL Connection</span>
                <span class="test-value"><?php echo $dbStatus; ?></span>
            </div>
            
            <?php if ($configExists): ?>
            <div class="test-item">
                <span class="test-icon success">✓</span>
                <span class="test-label">Database Name</span>
                <span class="test-value"><?php echo defined('DB_NAME') ? DB_NAME : 'shop_db'; ?></span>
            </div>
            
            <div class="test-item">
                <span class="test-icon success">✓</span>
                <span class="test-label">Database Host</span>
                <span class="test-value"><?php echo defined('DB_HOST') ? DB_HOST : 'localhost'; ?></span>
            </div>
            <?php endif; ?>
        </div>
        
        <!-- File System -->
        <div class="test-section">
            <div class="section-title">📁 File System</div>
            
            <div class="test-item">
                <span class="test-icon success">✓</span>
                <span class="test-label">Project Directory</span>
                <span class="test-value"><?php echo __DIR__; ?></span>
            </div>
            
            <div class="test-item">
                <span class="test-icon <?php echo $uploadDirExists ? 'success' : 'warning'; ?>">
                    <?php echo $uploadDirExists ? '✓' : '⚠'; ?>
                </span>
                <span class="test-label">Upload Directory</span>
                <span class="test-value">
                    <?php echo $uploadDirExists ? 'Exists' : 'Not Found'; ?>
                    <?php if ($uploadDirExists): ?>
                        (<?php echo $uploadDirWritable ? 'Writable' : 'Not Writable'; ?>)
                    <?php endif; ?>
                </span>
            </div>
            
            <div class="test-item">
                <span class="test-icon <?php echo $configExists ? 'success' : 'error'; ?>">
                    <?php echo $configExists ? '✓' : '✗'; ?>
                </span>
                <span class="test-label">Configuration File</span>
                <span class="test-value">
                    <?php echo $configExists ? 'project_config.php (Found)' : 'Not Found'; ?>
                </span>
            </div>
        </div>
        
        <!-- Overall Status -->
        <div class="info-box">
            <h3>
                <?php if ($allPassed && $dbStatusIcon === 'success'): ?>
                    ✅ All Tests Passed!
                <?php else: ?>
                    ⚠️ Some Issues Detected
                <?php endif; ?>
            </h3>
            
            <?php if ($allPassed && $dbStatusIcon === 'success'): ?>
                <p>Your installation is complete and working correctly!</p>
                <ul>
                    <li>PHP is properly installed and configured</li>
                    <li>All required extensions are loaded</li>
                    <li>Database connection is working</li>
                    <li>Project files are accessible</li>
                </ul>
            <?php else: ?>
                <p>Please address the following issues:</p>
                <ul>
                    <?php if ($dbStatusIcon !== 'success'): ?>
                        <li>Database connection failed - Check MySQL is running in XAMPP</li>
                        <li>Verify database credentials in project_config.php</li>
                        <li>Make sure 'shop_db' database exists</li>
                    <?php endif; ?>
                    
                    <?php foreach ($extensionStatus as $ext => $loaded): ?>
                        <?php if (!$loaded): ?>
                            <li>Enable <?php echo $ext; ?> extension in php.ini</li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    
                    <?php if (!$uploadDirWritable && $uploadDirExists): ?>
                        <li>Make 'uploaded_img' directory writable</li>
                    <?php endif; ?>
                </ul>
            <?php endif; ?>
        </div>
        
        <!-- Quick Links -->
        <div style="text-align: center; margin-top: 30px;">
            <a href="home.php" class="btn">🏠 Go to Home Page</a>
            <a href="<?php echo 'http://localhost/phpmyadmin'; ?>" class="btn" target="_blank">🗄️ phpMyAdmin</a>
        </div>
        
        <div class="footer">
            <p><strong>Grocery Store Project</strong></p>
            <p>Installation Test - <?php echo date('Y-m-d H:i:s'); ?></p>
            <p style="margin-top: 10px; font-size: 0.9em;">
                Project Drive: <?php echo $projectDrive; ?> | 
                PHP Drive: <?php echo $phpDrive; ?> | 
                PHP Version: <?php echo $phpVersion; ?>
            </p>
        </div>
    </div>
</body>
</html>
