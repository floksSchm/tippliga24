<?php 
	include_once('../../../include/connect.php');

	if(isset($_POST['poststartSpieltag'])) {
		$startSpieltag = $_POST['poststartSpieltag'];
		$saisonJahr = $_POST['postsaisonJahr'];
		$ligaKuerzel = $_POST['postligaKuerzel'];
		$tblDaten = $_POST['posttblDaten'];
		$anzahlSpieltag = $_POST['postanzahlSpieltag'];

		mysqli_query($conn, 'TRUNCATE TABLE '.$tblDaten);

		$insertSpieltag = 1;

		for($n = 0; $n < $anzahlSpieltag; $n++) {
			$url = 'http://www.openligadb.de/api/getmatchdata/'.$ligaKuerzel.'/'.$saisonJahr.'/'.$startSpieltag;

			$data = file_get_contents($url);
			$obj = json_decode($data);

			foreach ($obj as $spieltag => $values) {
				$matchID = $values->MatchID;
				$team1 = $values->Team1->TeamName;
				$team1Icon = $values->Team1->TeamIconUrl;
				$team2 = $values->Team2->TeamName;
				$team2Icon = $values->Team2->TeamIconUrl;

				if($values->MatchDateTime != '') {
					$matchDateTime = str_replace('T', ' ', $values->MatchDateTime);
				} else {
					$matchDateTime = 0;
				}

				if(count($values->MatchResults) != 0) {
					for($x = 0; $x < count($values->MatchResults); $x++) {
						if($values->MatchResults[$x]->ResultName == 'Endergebnis') {
							if($values->MatchResults[$x]->PointsTeam1 != '') {
								$pointsTeam1 = $values->MatchResults[$x]->PointsTeam1;
							} else {
								$pointsTeam1 = 0;
							}

							if($values->MatchResults[$x]->PointsTeam2 != '')	{
								$pointsTeam2 = $values->MatchResults[$x]->PointsTeam2;
							} else {
								$pointsTeam2 = 0;
							}
						} 
						if($values->MatchResults[$x]->ResultName == 'Halbzeitergebnis') {
							if($values->MatchResults[$x]->PointsTeam1 != '') {
								$htPointsTeam1 = $values->MatchResults[$x]->PointsTeam1;
							} else {
								$htPointsTeam1 = 0;
							}

							if($values->MatchResults[$x]->PointsTeam2 != '')	{
								$htPointsTeam2 = $values->MatchResults[$x]->PointsTeam2;
							} else {
								$htPointsTeam2 = 0;
							}		
						}
					}
				} else {
					$pointsTeam1 = 0;
					$pointsTeam2 = 0;
					$htPointsTeam1 = 0;
					$htPointsTeam2 = 0;
				}

				
				

				if($values->MatchIsFinished) {
					$matchIsFinished = 1;
				} else {
					$matchIsFinished = 0;
				}

				$sql = 'INSERT INTO '.$tblDaten.' VALUES ('.$matchID.','.$insertSpieltag.',"'.$matchDateTime.'","'.$team1.'","'.$team1Icon.'","'.$team2.'","'.$team2Icon.'",'.$pointsTeam1.','.$pointsTeam2.','.$htPointsTeam1.','.$htPointsTeam2.','.$matchIsFinished.',0)';

				$result = mysqli_query($conn, $sql);
				

		
			}
		$startSpieltag++;	
		$insertSpieltag++;
		}


		

		mysqli_close($conn);	
	} 
?> 