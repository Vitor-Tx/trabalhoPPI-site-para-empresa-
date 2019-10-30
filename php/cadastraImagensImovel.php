<?php 

    require "conexaoMysql.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $msgErro = "";

        $targetDir  = "../assets/images/uploads/";
        $allowTypes = array('jpg','png','jpeg');

        $id = $_POST["id"];

        $nomeArquivos = array();
        $x = 0;

        date_default_timezone_set("America/Sao_Paulo"); 

        $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
        if (!empty(array_filter($_FILES["imagens"]["name"]))) {
            foreach ($_FILES["imagens"]["name"] as $key=>$val) {
                $x++;

                $fileName = $id . "-" . date('dmy-his-') . $x . "." . pathinfo($_FILES['imagens']['name'][$key], PATHINFO_EXTENSION); 

                $targetFilePath = $targetDir . $fileName;

                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                if(in_array($fileType, $allowTypes)) {
                    if(move_uploaded_file($_FILES["imagens"]["tmp_name"][$key], $targetFilePath)){
                        array_push($nomeArquivos, $fileName);
                    } else {
                        $errorUpload .= $_FILES['imagens']['name'][$key].', ';
                    }
                } else {
                    $errorUploadType .= $_FILES['imagens']['name'][$key].', ';
                }
            }
        }

        if (count($nomeArquivos) > 0) {
            try {
                $st = $conn->prepare("INSERT INTO imagem (Imagem, ImovelID) VALUES (?, $id)");

                foreach ($nomeArquivos as $imagem) {
                    $st->execute([$imagem]);
                }
            } catch (Exception $e) {
                throw $e;
            }
        }

        if ($errorUpload != "") {
            echo $errorUpload;
        } else {
            echo "Imóvel cadastrado com sucesso";
        }
    }

?>