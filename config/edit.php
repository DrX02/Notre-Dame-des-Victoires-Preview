<?php
require 'config.php';
$id = $_GET['id'];
$sql = 'SELECT * FROM posts WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modifier le post</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../config/css/config.css">
  <style></style>
</head>
<body>
  <div class="container mx-auto p-8 max-w-2xl">
    <div class="mb-8">
      <h2 class="text-3xl font-semibold text-center text-gray-800">Modifier le post</h2>
      <p class="text-center text-gray-500 mt-2">Mettez à jour votre contenu</p>
    </div>
    
    <form action="update.php" method="post" enctype="multipart/form-data" class="form-card bg-white p-8 mb-4">
      <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
      
      <div class="mb-6">
        <label for="title" class="block text-gray-700 text-sm font-medium mb-2">Titre</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" 
               class="form-input w-full py-3 px-4 text-gray-700" required>
      </div>
      
      <div class="mb-6">
        <label for="content" class="block text-gray-700 text-sm font-medium mb-2">Contenu</label>
        <textarea id="content" name="content" rows="6" 
                  class="form-input w-full py-3 px-4 text-gray-700 resize-none" required><?php echo htmlspecialchars($post['content']); ?></textarea>
      </div>
      
      <div class="mb-8">
        <label class="block text-gray-700 text-sm font-medium mb-3">Media</label>
        
        <?php if ($post['media']): ?>
          <div class="mb-4">
            <p class="text-sm text-gray-500 mb-2">Media actuel:</p>
            <div class="media-preview">
              <?php if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $post['media'])): ?>
                <img src="<?php echo htmlspecialchars($post['media']); ?>" alt="Media" class="w-full h-64 object-cover">
              <?php elseif (preg_match('/\.(mp4|mov|avi)$/i', $post['media'])): ?>
                <video controls class="w-full h-64 object-cover">
                  <source src="<?php echo htmlspecialchars($post['media']); ?>" type="video/mp4">
                  Votre navigateur ne prend pas en charge les vidéos.
                </video>
              <?php endif; ?>
            </div>
          </div>
        <?php endif; ?>
        
        <div class="file-input-wrapper">
          <label for="media" class="file-input-label">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Changer le fichier
          </label>
          <input type="file" id="media" name="media" accept="image/*,video/*" 
                 class="hidden" onchange="updateFileName(this)">
        </div>
        <p id="file-name" class="file-name">Aucun nouveau fichier sélectionné</p>
        <p class="text-xs text-gray-500 mt-2">Laissez vide pour conserver le média actuel</p>
      </div>
      
      <div class="flex items-center justify-center">
        <a href="index.php" class="text-gray-500 font-medium py-2 px-6 mr-4 hover:text-gray-700 transition">Annuler</a>
        <button type="submit" class="submit-button text-white font-medium py-3 px-8">
          Enregistrer
        </button>
      </div>
    </form>
  </div>

  <script>
    function updateFileName(input) {
      const fileName = input.files[0] ? input.files[0].name : 'Aucun nouveau fichier sélectionné';
      document.getElementById('file-name').textContent = fileName;
    }
  </script>
</body>
</html>