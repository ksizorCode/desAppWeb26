<?php
/**
 * File Explorer Pro - Advanced Directory Listing
 * - Expanding subfolders (AJAX)
 * - Highlights index.html / index.php
 * - Image thumbnails
 */

// Helper to format size
function formatSize($bytes) {
    if ($bytes >= 1073741824) return number_format($bytes / 1073741824, 2) . ' GB';
    if ($bytes >= 1048576) return number_format($bytes / 1048576, 2) . ' MB';
    if ($bytes >= 1024) return number_format($bytes / 1024, 2) . ' KB';
    return $bytes . ' bytes';
}

// Function to get directory content
function getDirectoryContent($path, $relativeBase = '') {
    $files = @scandir($path);
    if (!$files) return [];

    $filteredFiles = array_filter($files, function($file) {
        return $file !== '.' && $file !== '..' && $file[0] !== '.';
    });

    $directories = [];
    $onlyFiles = [];

    foreach ($filteredFiles as $file) {
        $fullPath = $path . DIRECTORY_SEPARATOR . $file;
        $relPath = ($relativeBase ? $relativeBase . '/' : '') . $file;
        $isDir = is_dir($fullPath);
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        
        $item = [
            'name' => $file,
            'relPath' => $relPath,
            'isDir' => $isDir,
            'size' => $isDir ? '-' : formatSize(@filesize($fullPath)),
            'modified' => date("Y-m-d H:i", @filemtime($fullPath)),
            'ext' => $ext,
            'isSpecial' => ($file === 'index.html' || $file === 'index.php'),
            'isImage' => in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'avif'])
        ];

        if ($isDir) {
            $directories[] = $item;
        } else {
            $onlyFiles[] = $item;
        }
    }

    usort($directories, fn($a, $b) => strcasecmp($a['name'], $b['name']));
    usort($onlyFiles, fn($a, $b) => strcasecmp($a['name'], $b['name']));

    return array_merge($directories, $onlyFiles);
}

// AJAX Request Handler
if (isset($_GET['ajax_dir'])) {
    header('Content-Type: application/json');
    $requestedDir = realpath(__DIR__ . DIRECTORY_SEPARATOR . $_GET['ajax_dir']);
    
    // Security check: ensure the path is within __DIR__
    if ($requestedDir && strpos($requestedDir, realpath(__DIR__)) === 0) {
        echo json_encode(getDirectoryContent($requestedDir, $_GET['ajax_dir']));
    } else {
        echo json_encode([]);
    }
    exit;
}

$initialFiles = getDirectoryContent(__DIR__);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explorador Pro | <?php echo basename(__DIR__); ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        :root {
            --bg-color: #0b0f1a;
            --card-bg: rgba(22, 28, 45, 0.7);
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
            --accent: #38bdf8;
            --accent-glow: rgba(56, 189, 248, 0.2);
            --special-bg: rgba(56, 189, 248, 0.1);
            --special-border: rgba(56, 189, 248, 0.3);
            --border: rgba(255, 255, 255, 0.08);
            --glass-blur: 16px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            background-image: 
                radial-gradient(at 10% 10%, rgba(56, 189, 248, 0.1) 0px, transparent 40%),
                radial-gradient(at 90% 90%, rgba(139, 92, 246, 0.1) 0px, transparent 40%);
            color: var(--text-primary);
            min-height: 100vh;
            padding: 2.5rem 1.5rem;
            line-height: 1.5;
        }

        .container {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
            animation: fadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        header { margin-bottom: 3rem; }
        h1 {
            font-family: 'Outfit', sans-serif;
            font-size: 2.8rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            background: linear-gradient(to right, #fff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .search-container {
            position: relative;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
        }
        .search-container svg {
            position: absolute;
            left: 1.2rem;
            color: var(--text-secondary);
            pointer-events: none;
            z-index: 10;
        }
        #searchInput {
            width: 100%;
            padding: 1.2rem 1.2rem 1.2rem 3.5rem;
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 16px;
            color: white;
            font-size: 1.05rem;
            backdrop-filter: blur(var(--glass-blur));
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            outline: none;
        }
        #searchInput:focus {
            border-color: var(--accent);
            box-shadow: 0 0 20px var(--accent-glow);
        }

        .file-list {
            background: var(--card-bg);
            backdrop-filter: blur(var(--glass-blur));
            border: 1px solid var(--border);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .file-header {
            display: grid;
            grid-template-columns: 3fr 1fr 1fr;
            padding: 1.2rem 2rem;
            background: rgba(255, 255, 255, 0.03);
            font-weight: 600;
            color: var(--text-secondary);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            border-bottom: 1px solid var(--border);
        }

        .item-wrapper { width: 100%; }
        
        .file-item {
            display: grid;
            grid-template-columns: 3fr 1fr 1fr;
            padding: 1rem 2rem;
            border-bottom: 1px solid var(--border);
            align-items: center;
            transition: background 0.2s ease, transform 0.2s ease;
            text-decoration: none;
            color: inherit;
            cursor: pointer;
        }
        .file-item:hover { background: rgba(255, 255, 255, 0.04); }
        
        /* Magical Glow & Item Highlight (RPG Legend Style) */
        .file-item.special-file {
            background: rgba(56, 189, 248, 0.08);
            border-left: 4px solid var(--accent);
            position: relative;
            overflow: hidden;
            animation: magicPulse 3s infinite ease-in-out;
            box-shadow: inset 0 0 30px rgba(14, 165, 233, 0.15);
        }

        .file-item.special-file::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(
                transparent, 
                rgba(56, 189, 248, 0.2), 
                transparent 40%
            );
            animation: rotateAura 8s linear infinite;
            z-index: 0;
            pointer-events: none;
        }

        .file-item.special-file .file-name span {
            color: var(--accent);
            font-weight: 700;
            text-shadow: 0 0 12px rgba(56, 189, 248, 0.6);
            z-index: 2;
            position: relative;
        }

        .file-item.special-file .special-icon {
            background: var(--accent);
            color: white;
            box-shadow: 0 0 20px var(--accent);
            animation: iconPulse 2s infinite alternate cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 2;
        }

        /* Sparkle particles */
        .sparkle {
            position: absolute;
            width: 3px;
            height: 3px;
            background: white;
            border-radius: 50%;
            pointer-events: none;
            z-index: 10;
            box-shadow: 0 0 6px white;
            animation: sparkleFly 2s ease-out forwards;
        }

        @keyframes magicPulse {
            0%, 100% { background: rgba(56, 189, 248, 0.05); }
            50% { background: rgba(56, 189, 248, 0.15); }
        }

        @keyframes rotateAura {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        @keyframes iconPulse {
            from { transform: scale(1); filter: brightness(1) drop-shadow(0 0 5px var(--accent)); }
            to { transform: scale(1.15); filter: brightness(1.5) drop-shadow(0 0 15px var(--accent)); }
        }

        @keyframes sparkleFly {
            0% { transform: translate(0, 0) scale(0); opacity: 0; }
            50% { opacity: 1; }
            100% { transform: translate(var(--dx), var(--dy)) scale(1.5); opacity: 0; }
        }

        .file-name {
            display: flex;
            align-items: center;
            gap: 1.2rem;
            font-weight: 500;
        }

        /* Thumbnail styling */
        .thumb {
            width: 42px;
            height: 42px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid var(--border);
            background: #000;
        }

        .file-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.05);
            color: var(--text-secondary);
            flex-shrink: 0;
        }
        .dir-icon { background: rgba(234, 179, 8, 0.1); color: #eab308; }
        .special-icon { background: rgba(56, 189, 248, 0.1); color: var(--accent); }

        .file-size, .file-date {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        /* Subfolder container */
        .sub-folder {
            display: none;
            padding-left: 2rem;
            background: rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid var(--border);
        }
        .expanded + .sub-folder { display: block; }

        .chevron {
            transition: transform 0.3s ease;
            color: var(--text-secondary);
        }
        .expanded .chevron { transform: rotate(90deg); }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .file-header { display: none; }
            .file-item { grid-template-columns: 1fr; gap: 0.5rem; padding: 1.2rem; }
            .file-size, .file-date { padding-left: 4rem; opacity: 0.7; font-size: 0.8rem; }
            .sub-folder { padding-left: 1rem; }
        }
    </style>
</head>
<body>

    <div class="container">
        <header>
            <h1>Explorador Pro</h1>
        </header>

        <div class="search-container">
            <i data-lucide="search" size="22"></i>
            <input type="text" id="searchInput" placeholder="Filtrar archivos, carpetas, imágenes..." autocomplete="off">
        </div>

        <div class="file-list" id="mainList">
            <div class="file-header">
                <div>Elemento</div>
                <div>Tamaño</div>
                <div>Modificado</div>
            </div>
            <div id="fileContainer">
                <?php foreach ($initialFiles as $item): ?>
                    <?php renderItem($item); ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <?php
    function renderItem($item) {
        $class = $item['isSpecial'] ? 'special-file' : '';
        $icon = $item['isDir'] ? 'folder' : ($item['isSpecial'] ? 'star' : 'file-text');
        $iconClass = $item['isDir'] ? 'dir-icon' : ($item['isSpecial'] ? 'special-icon' : '');
        ?>
        <div class="item-wrapper" data-path="<?php echo htmlspecialchars($item['relPath']); ?>">
            <div class="file-item <?php echo $class; ?>" 
                 onclick="<?php echo $item['isDir'] ? "toggleFolder(this, '".htmlspecialchars($item['relPath'])."')" : "window.open('".htmlspecialchars($item['relPath'])."')" ?>" 
                 data-name="<?php echo strtolower(htmlspecialchars($item['name'])); ?>">
                <div class="file-name">
                    <?php if ($item['isDir']): ?>
                        <i data-lucide="chevron-right" class="chevron" size="18"></i>
                    <?php endif; ?>
                    
                    <?php if ($item['isImage']): ?>
                        <img src="<?php echo htmlspecialchars($item['relPath']); ?>" class="thumb" alt="">
                    <?php else: ?>
                        <div class="file-icon <?php echo $iconClass; ?>">
                            <i data-lucide="<?php echo $icon; ?>"></i>
                        </div>
                    <?php endif; ?>
                    
                    <span><?php echo htmlspecialchars($item['name']); ?></span>
                </div>
                <div class="file-size"><?php echo $item['size']; ?></div>
                <div class="file-date"><?php echo $item['modified']; ?></div>
            </div>
            <?php if ($item['isDir']): ?>
                <div class="sub-folder" id="folder-<?php echo md5($item['relPath']); ?>"></div>
            <?php endif; ?>
        </div>
        <?php
    }
    ?>

    <script>
        lucide.createIcons();

        const searchInput = document.getElementById('searchInput');

        async function toggleFolder(element, path) {
            const wrapper = element.closest('.item-wrapper');
            const subFolder = wrapper.querySelector('.sub-folder');
            
            if (element.classList.contains('expanded')) {
                element.classList.remove('expanded');
                return;
            }

            // If empty, fetch content
            if (subFolder.innerHTML === '') {
                subFolder.innerHTML = '<div style="padding: 1rem; color: #94a3b8; font-size: 0.9rem;">Cargando...</div>';
                try {
                    const response = await fetch(`index.php?ajax_dir=${encodeURIComponent(path)}`);
                    const data = await response.json();
                    
                    if (data.length === 0) {
                        subFolder.innerHTML = '<div style="padding: 1rem; color: #94a3b8; font-size: 0.8rem; font-style: italic;">Carpeta vacía</div>';
                    } else {
                        subFolder.innerHTML = '';
                        data.forEach(item => {
                            const itemHtml = createItemHtml(item);
                            subFolder.appendChild(itemHtml);
                        });
                        lucide.createIcons();
                    }
                } catch (e) {
                    subFolder.innerHTML = '<div style="padding: 1rem; color: #ef4444;">Error al cargar</div>';
                }
            }
            
            element.classList.add('expanded');
        }

        function createItemHtml(item) {
            const div = document.createElement('div');
            div.className = 'item-wrapper';
            div.dataset.path = item.relPath;
            
            const isSpecial = item.name === 'index.html' || item.name === 'index.php';
            const itemClass = isSpecial ? 'file-item special-file' : 'file-item';
            const icon = item.isDir ? 'folder' : (isSpecial ? 'star' : 'file-text');
            const iconClass = item.isDir ? 'file-icon dir-icon' : (isSpecial ? 'file-icon special-icon' : 'file-icon');
            
            let content = '';
            if (item.isImage) {
                content = `<img src="${item.relPath}" class="thumb" alt="">`;
            } else {
                content = `<div class="${iconClass}"><i data-lucide="${icon}"></i></div>`;
            }

            div.innerHTML = `
                <div class="${itemClass}" onclick="${item.isDir ? `toggleFolder(this, '${item.relPath}')` : `window.open('${item.relPath}')`}" data-name="${item.name.toLowerCase()}">
                    <div class="file-name">
                        ${item.isDir ? '<i data-lucide="chevron-right" class="chevron" size="18"></i>' : ''}
                        ${content}
                        <span>${item.name}</span>
                    </div>
                    <div class="file-size">${item.size}</div>
                    <div class="file-date">${item.modified}</div>
                </div>
                ${item.isDir ? `<div class="sub-folder"></div>` : ''}
            `;
            return div;
        }

        // Search Filter (recursive)
        searchInput.addEventListener('input', (e) => {
            const term = e.target.value.toLowerCase();
            const allItems = document.querySelectorAll('.file-item');
            
            allItems.forEach(item => {
                const name = item.dataset.name;
                if (name && name.includes(term)) {
                    item.style.display = 'grid';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        // Sparkle Generator for Magical Items
        function createSparkles() {
            const specialItems = document.querySelectorAll('.special-file');
            specialItems.forEach(item => {
                if (Math.random() > 0.8) {
                    const sparkle = document.createElement('div');
                    sparkle.className = 'sparkle';
                    
                    const rect = item.getBoundingClientRect();
                    const x = Math.random() * rect.width;
                    const y = Math.random() * rect.height;
                    
                    sparkle.style.left = x + 'px';
                    sparkle.style.top = y + 'px';
                    
                    sparkle.style.setProperty('--dx', (Math.random() - 0.5) * 100 + 'px');
                    sparkle.style.setProperty('--dy', (Math.random() - 0.5) * 100 + 'px');
                    
                    item.appendChild(sparkle);
                    setTimeout(() => sparkle.remove(), 2000);
                }
            });
        }

        setInterval(createSparkles, 150);
    </script>
</body>
</html>
