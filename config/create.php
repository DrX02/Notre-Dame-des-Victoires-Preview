<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajouter un nouveau post</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../config/css/config.css">
  <style></style>
</head>
<body>
  <div class="container mx-auto p-8 max-w-2xl">
    <div class="mb-8">
      <h2 class="text-3xl font-semibold text-center text-gray-800">Ajouter un nouveau post</h2>
      <p class="text-center text-gray-500 mt-2">Partagez votre contenu avec la communauté</p>
    </div>
    
    <form action="store.php" method="post" enctype="multipart/form-data" class="form-card bg-white p-8 mb-4">
      <div class="mb-6">
        <label for="title" class="block text-gray-700 text-sm font-medium mb-2">Titre</label>
        <input type="text" id="title" name="title" placeholder="Entrez un titre captivant" 
               class="form-input w-full py-3 px-4 text-gray-700" required>
      </div>
      
      <div class="mb-6">
        <label for="content" class="block text-gray-700 text-sm font-medium mb-2">Contenu</label>
        <textarea id="content" name="content" rows="6" placeholder="Rédigez votre contenu ici..." 
                  class="form-input w-full py-3 px-4 text-gray-700 resize-none" required></textarea>
      </div>
      
      <div class="mb-8">
        <label class="block text-gray-700 text-sm font-medium mb-3">Media</label>
        <div class="file-input-wrapper">
          <label for="media" class="file-input-label">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Choisir un fichier
          </label>
          <input type="file" id="media" name="media" accept="image/*,video/*" 
                 class="hidden" onchange="updateFileName(this)">
        </div>
        <p id="file-name" class="file-name">Aucun fichier sélectionné</p>
      </div>
      
      <div class="flex items-center justify-center">
        <button type="submit" class="submit-button text-white font-medium py-3 px-8">
          Publier
        </button>
      </div>
    </form>
  </div>

  <script>
    function updateFileName(input) {
      const fileName = input.files[0] ? input.files[0].name : 'Aucun fichier sélectionné';
      document.getElementById('file-name').textContent = fileName;
    }
  </script>
</body>
</html>