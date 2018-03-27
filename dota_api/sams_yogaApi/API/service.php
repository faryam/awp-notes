<?php
	class service
	{
		// read product
		function readHeros(){
			require('core/database.php');
			require('models/Hero.php');
			// instantiate database and hero object
			$database = new Database();
			$db = $database->getConnection();
			 
			// initialize object
			$hero = new Hero($db);
			 
			// query products
			$stmt = $hero->read();
			$num = $stmt->rowCount();
			$result=array();
			// check if more than 0 record found
			if($num>0){
				// heros array
				$result["data"]=array();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					// extract row
					// this will make $row['name'] to
					// just $name only
					
					extract($row);
					$hero_item=array(
						"id" => $id,
						"name" => $name,
						"img" => $img,
						"local_name" => $local_name,
						"strengths"=>$hero->readStrengths($id),
						"counter_heros"=>$hero->readCounters($id)
					);
					array_push($result["data"], $hero_item);
				}
				$result["status"]='ok';
				$result["message"]='Heros are loaded successfully';
				
			}else{
				$result["status"]='ok';
				$result["message"]='Heros are loaded successfully';
			}
			return $result;
		}
		
		function readHero()
		{
			require('core/database.php');
			require('models/Hero.php');
			// instantiate database and product object
			$database = new Database();
			$db = $database->getConnection();
			 
			// initialize object
			$hero = new Hero($db);
			$hero ->id=$_GET['id'];
			// query products
			$hero->readOne();
			$result=array();
			$result["data"]=array(
						"id" => $hero->id,
						"name" => $hero->name,
						"img" => $hero->img,
						"local_name" =>$hero->local_name,
						"strengths"=>$hero->hero_strengths,
						"counter_heros"=>$hero->hero_counters
					);
			$result["status"]='ok';
			$result["message"]='Hero loaded successfully';
			return $result;

		}


		function bestPicks()
		{
			require('core/database.php');
			require('models/Hero.php');
			// instantiate database and product object
			$database = new Database();
			$db = $database->getConnection();
			 
			// initialize object
			$hero = new Hero($db);
			$ids=$_GET['ids'];

			// query products
			
			$stmt = $hero->readBestPicks($ids);
			$num = $stmt->rowCount();
			$result=array();
			$result["data"]=array();
			// check if more than 0 record found
			if($num>0){
				// heros array
				
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					// extract row
					// this will make $row['name'] to
					// just $name only
					
					extract($row);
					$hero_item=array(
						"id" => $id,
						"name" => $name,
						"img" => $img,
						"local_name" => $local_name,
						"strengths"=>$hero->readStrengths($id),
						"counter_heros"=>$hero->readCounters($id)
					);
					array_push($result["data"], $hero_item);
				}
				$result["status"]='ok';
				$result["message"]='Best Picks are loaded successfully';
				
			}else{
				$result["status"]='ok';
				$result["message"]='Best Picks are loaded successfully';
			}
			return $result;

		}

		function playerData()
		{
			
			//echo id;die();
			$id=substr($_GET['id'], 3) - 61197960265728;
			$ch = curl_init('https://api.opendota.com/api/players/'.$id);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			$result = curl_exec($ch);
			curl_close($ch);
			$data = json_decode($result);
			$result=array();
			$result['name']=$data->profile->personaname;
			$result['img']=$data->profile->avatarfull;
			if (isset($data->rank_tier)) {
				$rank_tier=$data->rank_tier;
				$ranks=['Herald', 'Guardian', 'Crusader', 'Archon', 'Legend', 'Ancient', 'Divine'];
				$result['rank_tier']=$ranks[floor($rank_tier/10)-1].' '.$rank_tier%10;
			}
			else
			{
				$result['rank_tier']='Uncalibrated';
			}
			$ch = curl_init('https://api.opendota.com/api/players/'.$id.'/wl');
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			$res = curl_exec($ch);
			curl_close($ch);
			$data = json_decode($res);
			$result['wins']=$data->win;
			$result['loses']=$data->lose;
			$ch = curl_init('https://api.opendota.com/api/players/'.$id.'/heroes');
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			$res = curl_exec($ch);
			curl_close($ch);
			$data = json_decode($res);
			$best_heros=array();
			require('core/database.php');
			require('models/Hero.php');
			// instantiate database and product object
			$database = new Database();
			$db = $database->getConnection();
			 
			// initialize object
			$hero = new Hero($db);
			for ($i=0; $i <5 ; $i++)
			{
				
				array_push($best_heros, $hero->get_best_heros($data[$i]));
			}
			$result["top_heros"]=$best_heros;
			$result["status"]='ok';
			$result["message"]='Player profile loaded successfully';
			// print_r($result);die();
			return $result;

		}


		function playerMatchesData()
		{
			
			//echo id;die();
			$id=substr($_GET['id'], 3) - 61197960265728;
			$ch = curl_init('https://api.opendota.com/api/players/'.$id.'/recentMatches');
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			$result = curl_exec($ch);
			curl_close($ch);
			$data = json_decode($result);
			$result=array();
			$result['matches']=array();
			require('core/database.php');
			require('models/Hero.php');
			// instantiate database and product object
			$database = new Database();
			$db = $database->getConnection();
			 
			// initialize object
			$hero = new Hero($db);
			
			for ($i=0; $i <10 ; $i++)
			{
				//print_r($data[$i]);die();
				$match=array();
				$match['id']=$data[$i]->match_id;
				$match['hero_img']=$hero->getHeroImg($data[$i]->hero_id);
				$match['hero_name']=$hero->getHeroName($data[$i]->hero_id);
				$match['kills']=$data[$i]->kills;
				$match['deaths']=$data[$i]->deaths;
				$match['assists']=$data[$i]->assists;
				
				if ($data[$i]->radiant_win==1 && $data[$i]->player_slot <128)
				{
					
					$match['result']='Won';
				}
				else if ($data[$i]->radiant_win==0 &&$data[$i]->player_slot>=128)
				{
					$match['result']='Won';
				}
				else
				{
					$match['result']='Lost';
				}
				array_push($result['matches'], $match);
			}
			
			$result["status"]='ok';
			$result["message"]='Player profile loaded successfully';
			// print_r($result);die();
			return $result;

		}


		function matchData()
		{
			
			//echo id;die();
			$id=$_GET['id'];
			$ch = curl_init('https://api.opendota.com/api/matches/'.$id);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			$result = curl_exec($ch);
			curl_close($ch);
			$data = json_decode($result);
			$result=array();
			
			require('core/database.php');
			require('models/Hero.php');
			// instantiate database and product object
			$database = new Database();
			$db = $database->getConnection();
			 
			// initialize object
			$hero = new Hero($db);

			$result['match_id']=$id;
			$result['dire_score']=$data->dire_score;
			$result['radiant_score']=$data->radiant_score;
			if($data->radiant_win==1)
			{
				$result['winner']='Radiant Victory';
			}
			else
			{
				$result['winner']='Dire Victory';
			}
			$result['duration']=$data->duration;
			$result['radiants']=array();
			$result['dires']=array();
			for ($i=0; $i <count($data->players) ; $i++)
			{
				$player=array();
				$player['img']=$hero->getHeroImg($data->players[$i]->hero_id);
				if(isset($data->players[$i]->personaname) && $data->players[$i]->personaname!=null)
				{
					$player['name']=$data->players[$i]->personaname;
				}
				else
				{
					$player['name']='Anonymous';
				}
				$player['kills']=$data->players[$i]->kills;
				$player['deaths']=$data->players[$i]->deaths;
				$player['assists']=$data->players[$i]->assists;
				$player['last_hits']=$data->players[$i]->last_hits;
				$player['denies']=$data->players[$i]->denies;
				$player['gold_per_min']=$data->players[$i]->gold_per_min;
				$player['xp_per_min']=$data->players[$i]->xp_per_min;
				if($data->players[$i]->isRadiant==1)
				{
					array_push($result['radiants'], $player);
				}
				else
				{
					array_push($result['dires'], $player);
				}
				
			}


			

			
			
			
			$result["status"]='ok';
			$result["message"]='Player profile loaded successfully';
			// print_r($result);die();
			return $result;

		}
	}


		
?>