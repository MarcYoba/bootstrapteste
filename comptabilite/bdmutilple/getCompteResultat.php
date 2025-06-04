<?php
require_once("connexion.php");

class CompteResultat{

    public function __construct()
    {
        
    }

    public function GetCompteREsultat($annee){

        global $conn;
        $data =[];
        $indextable = 2;
        $tmparry = array();
        
        $sql = "SELECT id,reference,libelle ,signe, montant,ordre FROM compteResultat WHERE YEAR(dateexercice)= '$annee' AND groupe='marge'";
        $result = $conn->query($sql);
        $marge = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $marge += $row['montant'];
            array_push($data,$row);
        }
        $tab = ['reference'=>'XA',
            'libelle'=>'Total Marge Commerciale(somme TA a RB)',
            'signe'=>'',
            'montant'=>$marge,
            'ordre'=>0
        ];
        array_push($data,$tab);

        $sql = "SELECT id,reference,libelle ,signe, montant,ordre FROM compteResultat WHERE YEAR(dateexercice)= '$annee' AND groupe='chiffre'";
        $result = $conn->query($sql);
        $chiffre = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $chiffre += $row['montant'];
            array_push($data,$row);
        }
        $tab = ['reference'=>'XA',
            'libelle'=>'Total Chiffre d\'affairew(A+ B + C D)',
            'signe'=>'',
            'montant'=>$chiffre,
            'ordre'=>0
        ];
        array_push($data,$tab);

        $sql = "SELECT id,reference,libelle ,signe, montant,ordre FROM compteResultat WHERE YEAR(dateexercice)= '$annee' AND groupe='valeur'";
        $result = $conn->query($sql);
        $valeur = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $valeur += $row['montant'];
            array_push($data,$row);
        }
        $tab = ['reference'=>'XC',
            'libelle'=>'Total Valeur Ajoute(XB+RA+RB) +(Somme TE a Rj)',
            'signe'=>'',
            'montant'=>$valeur,
            'ordre'=>0
        ];
        array_push($data,$tab);

        $sql = "SELECT id,reference,libelle ,signe, montant,ordre FROM compteResultat WHERE YEAR(dateexercice)= '$annee' AND groupe='execedent'";
        $result = $conn->query($sql);
        $execedent = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $execedent += $row['montant'];
            array_push($data,$row);
        }
        $tab = ['reference'=>'XD',
            'libelle'=>'Total Exedent brut d\'exploitation(XC+RK)',
            'signe'=>'',
            'montant'=>$execedent,
            'ordre'=>0
        ];
        array_push($data,$tab);

        $sql = "SELECT id,reference,libelle ,signe, montant,ordre FROM compteResultat WHERE YEAR(dateexercice)= '$annee' AND groupe='resultat_exploitation'";
        $result = $conn->query($sql);
        $resultat_exploitation = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $resultat_exploitation += $row['montant'];
            array_push($data,$row);
        }
        $tab = ['reference'=>'XE',
            'libelle'=>'Total Resultat d\'exploitation(XD+TJ+RL)',
            'signe'=>'',
            'montant'=>$resultat_exploitation,
            'ordre'=>0
        ];
        array_push($data,$tab);

        $sql = "SELECT id,reference,libelle ,signe, montant,ordre FROM compteResultat WHERE YEAR(dateexercice)= '$annee' AND groupe='resultat_finaciere'";
        $result = $conn->query($sql);
        $resultat_finaciere = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $resultat_finaciere += $row['montant'];
            array_push($data,$row);
        }
        $tab = ['reference'=>'XF',
            'libelle'=>'Total Resultat Financier(somme TK a RN)',
            'signe'=>'',
            'montant'=>$resultat_finaciere,
            'ordre'=>0
        ];
        array_push($data,$tab);

        $tab = ['reference'=>'XG',
            'libelle'=>'Total Resultat des activites ordinaires(XE+XF)',
            'signe'=>'',
            'montant'=>$resultat_finaciere + $resultat_exploitation,
            'ordre'=>0
        ];
        array_push($data,$tab);

        $sql = "SELECT id,reference,libelle ,signe, montant,ordre FROM compteResultat WHERE YEAR(dateexercice)= '$annee' AND groupe='resultat_hors'";
        $result = $conn->query($sql);
        $resultat_hors = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $resultat_hors += $row['montant'];
            array_push($data,$row);
        }
        $tab = ['reference'=>'XH',
            'libelle'=>'Total Resultat hors activites ordinaires(somme TN a RP)',
            'signe'=>'',
            'montant'=>$resultat_hors,
            'ordre'=>0
        ];
        array_push($data,$tab);

        $sql = "SELECT id,reference,libelle ,signe, montant,ordre FROM compteResultat WHERE YEAR(dateexercice)= '$annee' AND groupe='resultat_net'";
        $result = $conn->query($sql);
        $resultat_net = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $resultat_net += $row['montant'];
            array_push($data,$row);
        }
        $tab = ['reference'=>'XH',
            'libelle'=>'Total Resultat net(XG+XH+RQ+RS)',
            'signe'=>'',
            'montant'=>$resultat_net+$resultat_finaciere + $resultat_exploitation + $resultat_hors,
            'ordre'=>0
        ];
        array_push($data,$tab);


        return $data; 
    }

    public function getElement($id) {
        global $conn;

        $sql = "SELECT * FROM compteResultat WHERE id='$id'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    
   
}

?>