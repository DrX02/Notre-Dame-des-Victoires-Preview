<?php
require 'config.php';
$sql = 'SELECT * FROM posts ORDER BY id DESC';
$statement = $pdo->prepare($sql);
$statement->execute();
$posts = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog des Événements</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.5/sweetalert2.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8fafc;
    }
    
    .header-gradient {
      background: linear-gradient(135deg, #004a77 0%, #00558a 50%, #006699 100%);
    }
    
    .logo-shadow {
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .event-card {
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
    }
    
    .event-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    
    .media-container {
      position: relative;
      overflow: hidden;
    }
    
    .action-button {
      transition: all 0.3s ease;
      border-radius: 10px;
    }
    
    .action-button:hover {
      transform: translateY(-2px);
    }
    
    .add-button {
      background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
      border-radius: 10px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);
    }
    
    .add-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 8px rgba(37, 99, 235, 0.3);
    }
    
    .edit-button {
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    }
    
    .delete-button {
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    }
    
    .card-content {
      position: relative;
    }
    
    .empty-state {
      background-color: white;
      border-radius: 16px;
      padding: 40px;
      text-align: center;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
    }
    
    /* Styles pour le défilement vertical de contenu */
    .card-content-scrollable {
      height: 150px;  /* Hauteur fixe pour la zone de contenu */
      overflow-y: auto;  /* Permet le défilement vertical */
      padding-right: 5px;  /* Espace pour la barre de défilement */
    }
    
    /* Style pour la barre de défilement */
    .card-content-scrollable::-webkit-scrollbar {
      width: 5px;
    }
    
    .card-content-scrollable::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 10px;
    }
    
    .card-content-scrollable::-webkit-scrollbar-thumb {
      background: #c5c5c5;
      border-radius: 10px;
    }
    
    .card-content-scrollable::-webkit-scrollbar-thumb:hover {
      background: #a0a0a0;
    }
    
    /* Suppression de la limitation à 3 lignes */
    .truncate-3-lines {
      display: block;
      overflow: visible;
      -webkit-line-clamp: unset;
      -webkit-box-orient: unset;
    }
  </style>
</head>
<body>
  <!-- En-tête -->
  <header class="header-gradient text-white py-8 text-center shadow-lg">
    <div class="container mx-auto px-4">
      <a href="../index.html" title="logo-NDV" class="inline-block mb-2">
        <img class="w-auto h-32 rounded-full border-4 border-white logo-shadow" src="../asset/logo-NDV-remove.jpg" alt="Logo NDV">
      </a>
      <h1 class="text-4xl font-bold mt-4">Blog des Événements</h1>
      <p class="text-xl mt-3 max-w-lg mx-auto opacity-90">Découvrez nos événements récents et à venir !</p>
    </div>
  </header>
  
  <!-- Contenu principal -->
  <main class="container mx-auto px-4 py-12">
    <div class="flex justify-between items-center mb-8">
      <h2 class="text-3xl font-semibold text-gray-800">Nos Événements</h2>
      <a href="create.php" class="add-button text-white font-medium py-3 px-6 inline-flex items-center">
        <i class="fas fa-plus mr-2"></i>
        Ajouter un événement
      </a>
    </div>
    
    <!-- Section des cartes d'événements -->
    <?php if (count($posts) > 0): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <?php foreach ($posts as $post): ?>
        <div class="event-card bg-white">
          <div class="media-container">
            <?php if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $post['media'])): ?>
              <img src="<?php echo htmlspecialchars($post['media']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" class="w-full h-64 object-cover">
            <?php elseif (preg_match('/\.(mp4|mov|avi)$/i', $post['media'])): ?>
              <video controls class="w-full h-64 object-cover">
                <source src="<?php echo htmlspecialchars($post['media']); ?>" type="video/mp4">
                Votre navigateur ne prend pas en charge les vidéos.
              </video>
            <?php else: ?>
              <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                <i class="fas fa-image text-gray-400 text-5xl"></i>
              </div>
            <?php endif; ?>
          </div>
          
          <div class="p-6 card-content">
            <h3 class="text-xl font-bold text-gray-800 mb-3"><?php echo htmlspecialchars($post['title']); ?></h3>
            
            <div class="card-content-scrollable mb-6">
              <p class="text-gray-600"><?php echo htmlspecialchars($post['content']); ?></p>
            </div>
            
            <div class="flex justify-between items-center mt-4 space-x-2">
              <a href="edit.php?id=<?php echo $post['id']; ?>" class="action-button edit-button text-white text-sm font-medium py-2 px-4 flex-1 text-center">
                <i class="fas fa-edit mr-2"></i> Modifier
              </a>
              <a href="javascript:void(0);" 
                 class="action-button delete-button text-white text-sm font-medium py-2 px-4 flex-1 text-center"
                 onclick="confirmDelete(<?php echo $post['id']; ?>, '<?php echo htmlspecialchars(addslashes($post['title'])); ?>')">
                <i class="fas fa-trash-alt mr-2"></i> Supprimer
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="empty-state">
      <div class="text-center">
        <i class="fas fa-calendar-day text-blue-500 text-6xl mb-4"></i>
        <h3 class="text-2xl font-semibold text-gray-800 mb-2">Aucun événement</h3>
        <p class="text-gray-600 mb-6">Il n'y a actuellement aucun événement publié.</p>
        <a href="create.php" class="add-button text-white font-medium py-3 px-6 inline-flex items-center">
          <i class="fas fa-plus mr-2"></i>
          Créer votre premier événement
        </a>
      </div>
    </div>
    <?php endif; ?>
  </main>
  
  <footer class="bg-gray-800 text-white py-8 mt-12">
    <div class="container mx-auto px-4 text-center">
      <p class="mb-4">&copy; <?php echo date('Y'); ?> - Tous droits réservés</p>
      <div class="flex justify-center space-x-4">
        <a href="#" class="text-white hover:text-blue-400"><i class="fab fa-facebook text-xl"></i></a>
        <a href="#" class="text-white hover:text-blue-400"><i class="fab fa-twitter text-xl"></i></a>
        <a href="#" class="text-white hover:text-blue-400"><i class="fab fa-instagram text-xl"></i></a>
      </div>
    </div>
  </footer>
  
  <!-- SweetAlert2 JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.5/sweetalert2.min.js"></script>
  <script>
    function confirmDelete(id, title) {
      Swal.fire({
        title: 'Êtes-vous sûr ?',
        html: `Voulez-vous vraiment supprimer l'événement <strong>${title}</strong> ?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Oui, supprimer',
        cancelButtonText: 'Annuler',
        reverseButtons: true,
        focusCancel: true,
        background: '#ffffff',
        borderRadius: '1rem',
        iconColor: '#ef4444',
        customClass: {
          confirmButton: 'focus:outline-none',
          cancelButton: 'focus:outline-none'
        }
      }).then((result) => {
        if (result.isConfirmed) {
          // Rediriger vers la page de suppression
          window.location.href = `delete.php?id=${id}`;
        }
      });
    }

    // Afficher un message de succès si présent dans l'URL (pour après une action)
    document.addEventListener('DOMContentLoaded', function() {
      const urlParams = new URLSearchParams(window.location.search);
      const message = urlParams.get('message');
      const status = urlParams.get('status');
      
      if (message && status) {
        let icon = 'info';
        if (status === 'success') icon = 'success';
        if (status === 'error') icon = 'error';
        
        Swal.fire({
          title: status === 'success' ? 'Succès!' : 'Information',
          text: message,
          icon: icon,
          timer: 3000,
          timerProgressBar: true,
          toast: true,
          position: 'top-end',
          showConfirmButton: false
        });
      }
    });
  </script>
</body>
</html>