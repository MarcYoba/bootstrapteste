<?php
 require_once("../connexion.php");
 header('Content-Type: application/json');


$json = file_get_contents('php://input');
$donnees = json_decode($json,true);
echo json_encode($reponse);
global $conn;
// if (empty($donnees)) {
//   $day = date('m');
// }else{
//   $day = $donnees;
// }

// $sql = "SELECT COALESCE(ROUND(SUM(v.prix),2), 0) AS prix 
//         FROM 
//             (SELECT 1 AS month UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 
//             UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL SELECT 11 UNION ALL SELECT 12) AS m
//         LEFT JOIN 
//             vente v ON m.month = MONTH(v.datevente) AND YEAR(v.datevente) = YEAR(NOW())
//         GROUP BY 
//             m.month
//         ORDER BY 
//             m.month";
// $result = $conn->query($sql);
// $data = [];
// while($row = mysqli_fetch_assoc($result)) {
//   array_push($data,$row);
// }
// $reponse = [
//      $data
//  ];
// echo json_encode($reponse);

?>