<?php
require '../conexao.php';
if (!isset($_GET['id']) || empty($_GET['id'])){
    header("Location:listar.php");
    exit;

}
$id=intval($_GET['id']);
try {
    $sql = "SELECT imagem FROM livros WHERE id = :id LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $livro = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($livro && !empty($livro['imagem'])) {
        $caminhoImagem = __DIR__ . '/../Imagens/' . $livro['imagem'];
        if (file_exists($caminhoImagem)) {
            unlink($caminhoImagem);
        }
    }

    $sql = "DELETE FROM livros WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    header("Location: listar.php");
    exit;

} catch (PDOException $e) {
    echo "Erro ao excluir: " . htmlspecialchars($e->getMessage());
}




?>
