<?php
ini_set("display_errors",1);

include("../../../config.php");

$login = $_POST["login"];
$token = $_POST["token"];
$idContexto = $_POST["idContexto"];

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
            t.turno as 'turno',
            concat(a.nome, ' ', a.sobrenome) as 'nomeAluno',
            a.ra as 'raAluno',
            a.email as 'emailAluno'

          FROM matriculaAlunoSemestre mas
          INNER JOIN aluno a ON a.id = mas.idAluno
          INNER JOIN semestreGradeTurma sgt ON sgt.id = mas.idSemestre
          INNER JOIN turma t ON t.id = sgt.idTurma
          INNER JOIN gradeCurso gc ON gc.id = t.idGrade
          INNER JOIN curso c ON c.id = gc.idCurso
          INNER JOIN semestreGrade sg ON sg.id = sgt.idSemestre
          INNER JOIN semestre s ON s.id = sg.semestre_id
          WHERE a.usuario = :p1 && a.token = :p2 && mas.id = :p3;";
  $consulta = $conexao->prepare($sql);
  $consulta->bindParam(":p1", $login);
  $consulta->bindParam(":p2", $token);
  $consulta->bindParam(":p3", $idContexto);
  $consulta->execute();
  $listaContextos = array();
  foreach ($consulta->fetchAll() as $inf) {
    $listaContextos["idContexto"] = $inf["idMatricula"];
    $listaContextos["curso"] = $inf["nomeCurso"];
    $listaContextos["semestre"] = $inf["semestre"];
    $listaContextos["ano"] = $inf["ano"];
    $listaContextos["diaInicio"] = $inf["diaInicioSemestre"];
    $listaContextos["diaFim"] = $inf["diaFinalSemestre"];
    $listaContextos["isAnual"] = $inf["isAnual"];
    $listaContextos["habilitacao"] = $inf["habilitacaoCurso"];
    $listaContextos["turno"] = $inf["turno"];
    $listaContextos["nomeAluno"] = $inf["nomeAluno"];
    $listaContextos["raAluno"] = $inf["raAluno"];
    $listaContextos["emailAluno"] = $inf["emailAluno"];
  }
  echo json_encode(array("sucesso" => 1, "erro" => 0, "contexto" => $listaContextos));
}else{
  echo json_encode(array("sucesso" => 0, "erro" => 1, "null" => 1));
}
