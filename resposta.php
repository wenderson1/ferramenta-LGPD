<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/resultado.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <title>Resultado</title>
</head>

<body>
    
    <div class="col-lg-11" id="" >
    <p> </p>
    <br>

    <?php 
        include("conexao.php");
        include("processar.php");

        ini_set('display_errors', 0 );
        error_reporting(0);

    for($i=0; $i<=sizeof($array);$i++){

        if($array[$i] == 1){
            $arrayCorreto[$i] = $array[$i];
        } elseif($array[$i] == 0){      
            $arrayIncorreto[$i] = $array[$i];           
        }

    }


    /**
     * quetionario ajudou a encontrar pontos fortes e fracos, adequado, contribuiu, nota de 1 a 10, auxiliou a empresa a adequadar, as orientações foram pertinententes, 
     */
    $correto = sizeof($arrayCorreto);
    $incorreto = sizeof($arrayIncorreto);
    $total = ($correto + $incorreto)-1;
    $porcentagem  = (($correto / $total) * 100);

    
    if(($porcentagem != 100) and (!is_nan($porcentagem))){
        echo '<div class="col-md-12"><h3 class="resposta"> Percentual de aderência à LGPD: '.number_format($porcentagem, 1, ",", "").'%, Quantidades de itens corretos: '.$correto.' / '.$total.' </h3>';
        if($porcentagem <=25){
            echo '<div class="progress">
                <div class="progress-bar progress-bar-striped bg-danger progress-bar-animated" role="progressbar" style="width: '.$porcentagem.'%" aria-valuenow="'.$porcentagem.'" aria-valuemin="0" aria-valuemax="100">'.number_format($porcentagem, 1, ",", "").'%</div>
                </div>';
        }elseif(($porcentagem >= 25) and ($porcentagem <= 50)){
            echo '<div class="progress">
                <div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" style="width: '.$porcentagem.'%" aria-valuenow="'.$porcentagem.'" aria-valuemin="0" aria-valuemax="100">'.number_format($porcentagem, 1, ",", "").'%</div>
                </div>';
        }elseif(($porcentagem >= 50) and ($porcentagem <= 75)){
            echo'<div class="progress">
                <div class="progress-bar progress-bar-striped bg-info progress-bar-animated" role="progressbar" style="width: '.$porcentagem.'%" aria-valuenow="'.$porcentagem.'" aria-valuemin="0" aria-valuemax="100">'.number_format($porcentagem, 1, ",", "").'%</div>
                </div>';
        }elseif(($porcentagem >= 75) and ($porcentagem <= 100)){
            echo'<div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: '.$porcentagem.'%" aria-valuenow="'.$porcentagem.'" aria-valuemin="0" aria-valuemax="100">'.number_format($porcentagem, 1, ",", "").'%</div>
                </div>';        
        }
        echo '</div>';
    }
    
    if($porcentagem==100){
        echo '<div class="col-md-12"><h5 class="pergunta">Parabens!! Sua empresa está de total acordo com o nosso checklist!!</h5>';
        echo '<h3 class="resposta">  Percentual de aderência à LGPD: '.number_format($porcentagem, 1, ",", "").'%, Quantidades de itens corretos: '.$correto.' / '.$total.' </h3>';
        echo '<div class="progress">
            <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">'.$porcentagem.'%</div>
            </div>';
        echo '</div>';
    } 

    if(is_nan($porcentagem)){
        echo '<div class="col-md-12"><h5 class="pergunta">Revise o questionário novamente!!<a href="checklist.php">Clicando aqui<a></h5></div> ';
    }
 
    for($x=0; $x<=sizeof($array);$x++){
   
        if($array[$x]==0){
            
            $query = "SELECT * FROM resposta WHERE ID_PERGUNTA = $x";
            $sql = mysqli_query($dbcon,$query);
        

            while($linha = $sql->fetch_array()){
            echo  ' <div class="col-md-12"><h5 class="pergunta">'.$linha['PERGUNTA'].'</h5>';
            echo '<p class="resposta">';
            echo $linha['RESPOSTA'];
            echo '</p></div> ';
        }        
    } 
}  
    ?>            
        <hr>  
        <div class="col-md-11" id="main-div">        
             <h3>  <a href="https://forms.gle/G5J6tCFaaeSq827n8">Por favor, nos dê seu feedback clicando aqui, isso é de extrema importância! :D <a></h3>
            </div>
        <p> </p>
        <br>
    </div>     
</body>
</html>
