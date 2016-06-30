<?php
ini_set("display_errors",1);

include("../../../config.php");

$login = $_POST["login"];
$token = $_POST["token"];

if($login != NULL && $token != NULL){
  $sql = "SELECT
            mas.id as 'idMatricula',
            c.nome as 'nomeCurso',
            s.semestre as 'semestre',
            s.ano as 'ano',
            s.diaInicio as 'diaInicioSemestre',
            s.diaFinal as 'diaFinalSemestre',
            s.isAnual as 'isAnual',
            c.habilitacao as 'habilitacaoCurso',
            t.turno as 'turno'
          FROM matriculaAlunoSemestre mas
          INNER JOIN aluno a ON a.id = mas.idAluno
          INNER JOIN semestreGradeTurma sgt ON sgt.id = mas.idSemestre
          INNER JOIN turma t ON t.id = sgt.idTurma
          INNER JOIN gradeCurso gc ON gc.id = t.idGrade
          INNER JOIN curso c ON c.id = gc.idCurso
          INNER JOIN semestreGrade sg ON sg.id = sgt.idSemestre
          INNER JOIN semestre s ON s.id = sg.semestre_id
          WHERE a.usuario = :p1 && a.token = :p2;";
  $consulta = $conexao->prepare($sql);
  $consulta->bindParam(":p1", $login);
  $consulta->bindParam(":p2", $token);
  $consulta->execute();
  $listaContextos = array();
  $i = 0;
  foreach ($consulta->fetchAll() as $inf) {
    $listaContextos[$i]["idContexto"] = $inf["idMatricula"];
    $listaContextos[$i]["curso"] = $inf["nomeCurso"];
    $listaContextos[$i]["semestre"] = $inf["semestre"];
    $listaContextos[$i]["ano"] = $inf["ano"];
    $listaContextos[$i]["diaInicio"] = $inf["diaInicioSemestre"];
    $listaContextos[$i]["diaFim"] = $inf["diaFinalSemestre"];
    $listaContextos[$i]["isAnual"] = $inf["isAnual"];
    $listaContextos[$i]["habilitacao"] = $inf["habilitacaoCurso"];
    $listaContextos[$i]["turno"] = $inf["turno"];
    $i++;
  }
  echo json_encode(array("sucesso" => 1, "erro" => 0, "contextos" => $listaContextos));
}else{
  echo json_encode(array("sucesso" => 0, "erro" => 1, "null" => 1));
}
