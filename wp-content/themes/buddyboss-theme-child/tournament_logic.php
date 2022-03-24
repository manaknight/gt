<?php
//mkd contest
//status 0 pending 1 complete 2 dropped
// Create Pods
// $email = 'sameer.rajputra55@gmail.com';
// $email_payload = array(
// 	'link' => site_url() . '/user/login',
// 	'email' => $email,
// 	'round_number' => 2

// );
// $response = send_email('eliminated', $email_payload, $email);
$response = create_pods_ajaxs(1);
echo '<pre>';print_r($response);exit();
// Function set 1st,2nd,3rd,4th and 5th winners
function set_winnersx($contest_id){
	global $wpdb;
	$pod = $wpdb->get_results("SELECT * FROM mkd_pods WHERE	contest_id = $contest_id ");
	if(!empty($pod)){
		$pod_id = $pod[0]->id;
		$winners = $wpdb->get_results("SELECT * FROM mkd_pod_competitors WHERE pod_id = $pod_id ORDER BY votes DESC");
		if(!empty($winners)){
			$wpdb->update('mkd_contest', [
				'winner_1' 		=> $winners[0],
				'winner_2' 		=> $winners[1],
				'winner_3' 		=> $winners[2],
				'winner_4' 		=> $winners[3],
				'winner_5' 		=> $winners[4],
			], array('id' => $contest_id));
		}
	}
	return true;
}

function create_pods_ajaxs($contest_id=0){
	global $wpdb;
	$today = date("Y-m-d");

	/**
	 * loop through all the pods
	 * find the candidate with minium voting
	 * and avoid that candidate to be appeared in the next pods
	 */
	// $user_id = get_current_user_id();
	// if(!$user_id)
	// {
	// 	return [
	// 		'data' => 0,
	// 		'message' => 'Please login.'
	// 	];exit();
	// }
	// $contest_id = $contest_id;
	//$contest_level = 1;
	//$contest_id = 1;
	if($contest_id == 0)
	{
		echo "No contest found";exit();
	}
	$contest_query = $wpdb->get_results("SELECT  * FROM mkd_contest where id = '$contest_id' AND status = 0");
	if(count($contest_query) == '0' && $contest_id)
	{
		return [
			'data' => 0,
			'message' => 'No pending contest found.'
		];exit();
	}
	$contest = $contest_query[0];
	$contest_level = $contest->contest_level;
	if($contest_level == 'final')
	{
		$num_winners = $contest->num_winners ? $contest->num_winners : 3;
		$contest_competitors = $wpdb->get_results("SELECT  * FROM mkd_pod_competitors where contest_id = '$contest_id' AND contest_level = 'final' ORDER BY votes DESC");
		//echo json_encode($contest_competitors);exit();
		$max_vote = max(array_column($contest_competitors, 'votes'));
		if($max_vote == '0')
		{
			$wpdb->update('mkd_contest', [
					'status' => 2
				], array('id' => $contest_id));
		}
		$winners = [];
		$winner_user_ids = [];
		$votes = array_column($contest_competitors, 'votes');
		$unique_votes = array_unique($votes);
		$winner_loop = 0;
		foreach ($unique_votes as $u_key => $vote_check) {
			$i = $u_key+1;
			if($i > $num_winners)
			{
				echo $i;exit();
				continue;
			}
			$winner_pc['winner_'.$i] = [];
			foreach ($contest_competitors as $i_key => $contest_competitor) {
				if($contest_competitor->votes == $vote_check)
				{
					$winner_pc['winner_'.$i][] = $contest_competitor;
				}
			}
			if(count($winner_pc['winner_'.$i]) == '1')
			{
				$winners['winner_'.$i] = $winner_pc['winner_'.$i][0]->portfolio_id;
				$winner_user_ids[] = $winner_pc['winner_'.$i][0]->user_id;
				$contest_user_id = $winner_pc['winner_'.$i][0]->user_id;
				$contest_user = $wpdb->get_results("SELECT  * FROM wp_users where ID = '$contest_user_id'")[0];
				$email = $contest_user->user_email;
				$email_payload = array(
					'link' => site_url() . '/index.php/winners/?contest_id='.$contest->id,
					'email' => $email,
					'postition' => $i == '1' ? 'First' : $i

				);
				$response = send_emails('congratulation-message', $email_payload, $email);
				continue;
			}
			$winner_loop = $i;
			foreach ($winner_pc['winner_'.$i] as $key => $winner_place) {
				if($winner_loop > $num_winners && (in_array($winner_place->user_id, $$winner_user_ids)))
				{
					echo $winner_loop;exit();
					continue;
				}
				$winner_key = array_rand($winner_pc['winner_'.$i]);
				$winners['winner_'.$winner_loop] = $winner_pc['winner_'.$i][$winner_key]->portfolio_id;
				$winner_user_ids[] = $winner_pc['winner_'.$i][$winner_key]->user_id;
				$contest_user_id = $winner_pc['winner_'.$i][$winner_key]->user_id;
				$contest_user = $wpdb->get_results("SELECT  * FROM wp_users where ID = '$contest_user_id'")[0];
				$email = $contest_user->user_email;
				$email_payload = array(
					'link' => site_url() . '/index.php/winners/?contest_id='.$contest->id,
					'email' => $email,
					'postition' => $winner_loop == '1' ? 'First' : $winner_loop

				);
				$response = send_emails('congratulation-message', $email_payload, $email);
				unset($winner_pc['winner_'.$i][$winner_key]);
				$winner_loop++;
			}
		}
		// foreach ($contest_competitors as $key => $contest_competitor) {
		// 	$freqs = array_count_values($contest_competitor->votes);
		// 	if($key < $num_winners)
		// 	{
		// 		$i = $key+1;
		// 		$winners['winner_'.$i] = $contest_competitor->portfolio_id;
		// 		$winner_user_ids[] = $contest_competitor->user_id;
		// 	}
		// }
		$winner_user_string = $$winner_user_ids ? implode(',', $winner_user_ids) : '';
		$not_in_voters = $winner_user_string == '' ? '' : " AND voter_id NOT IN ('$winner_user_string')"; 
		$random_competitors = $wpdb->get_results("SELECT  * FROM   mkd_pod_competitor_votes where contest_id='$contest_id' $not_in_voters");
		$key = array_rand($random_competitors);
		$draw_user_id = $random_competitors[$key]->voter_id;
		$draw_user_portfolio = $wpdb->get_results("SELECT  * FROM mkd_pod_competitors where contest_id = '$contest_id' AND user_id = '$draw_user_id' ORDER BY votes DESC");
		$winners['draw_winner'] = $draw_user_portfolio[0]->id;
		$contest_user_id = $draw_user_portfolio[0]->user_id;
		$contest_user = $wpdb->get_results("SELECT  * FROM wp_users where ID = '$contest_user_id'")[0];
		$email = $contest_user->user_email;
		$email_payload = array(
			'link' => site_url() . '/index.php/winners/?contest_id='.$contest->id,
			'email' => $email

		);
		$response = send_emails('drawwinner-message', $email_payload, $email);
		$winners['status'] = 1;
		$wpdb->update('mkd_contest',
			$winners, array('id' => $contest_id));
		exit();
	}
	if($contest_level != '0')
	{
		//winner from pod selection logic
		$contest_pods = $wpdb->get_results("SELECT  * FROM mkd_pods where contest_id = $contest_id AND contest_level = $contest_level");
		foreach ($contest_pods as $key => $contest_pod) {
			$pod_competitors = $wpdb->get_results("SELECT  * FROM  mkd_pod_competitors as pc WHERE pc.contest_id = '$contest_id' AND pc.contest_level = '$contest_level' AND pc.pod_id = '$contest_pod->id'");
			$max_vote = max(array_column($pod_competitors, 'votes'));
			if($max_vote == '0')
			{
				$winner_query = '';
			}
			else
			{
				//select greatest vote
				$pod_competitors_winners = $wpdb->get_results("SELECT  pc.* FROM  mkd_pod_competitors as pc WHERE pc.contest_id = '$contest_id' AND pc.contest_level = '$contest_level' AND pc.pod_id = '$contest_pod->id' AND votes = '$max_vote'");
				//remove those who didn't vote

				$pod_voters = $wpdb->get_results("SELECT  pv.* FROM  mkd_pod_competitor_votes as pv WHERE pv.contest_id = '$contest_id' AND pv.contest_level = '$contest_level' AND pv.pod_id = '$contest_pod->id'");
				$voter_ids = array_column($pod_voters, 'voter_id');
				$final_winners = [];
				foreach ($pod_competitors_winners as $key => $check_winner_vote) {
					if(in_array($check_winner_vote->user_id, $voter_ids))
					{
						$final_winners[] = $check_winner_vote;
					}
				}
				$key = array_rand($final_winners);
				$winner_portfolio = $final_winners[$key]->portfolio_id;
				$winner_query = " AND pc.portfolio_id != '$winner_portfolio'";
			}
			$pod_competitors_delete_list = $wpdb->get_results("SELECT  * FROM  mkd_pod_competitors as pc WHERE pc.contest_id = '$contest_id' AND pc.contest_level = '$contest_level' AND pc.pod_id = '$contest_pod->id' $winner_query");
			foreach ($pod_competitors_delete_list as $key => $list) {

				$contest_user = $wpdb->get_results("SELECT  * FROM wp_users where ID = '$list->user_id'")[0];
				$email = $contest_user->user_email;
				$email_payload = array(
					'link' => site_url() . '/index.php/tournament/?contest_id='.$contest_id,
					'email' => $email,
					'round_number' => $contest_level

				);
				$response = send_emails('eliminated', $email_payload, $email);
				$wpdb->get_results("UPDATE mkd_contest_portfolio SET status = 0 where portfolio_id = '$list->portfolio_id' AND contest_id = '$contest_id'");
					continue;
			}
		}
	}
	$contest_portfolios = $wpdb->get_results("SELECT  * FROM mkd_contest_portfolio where contest_id = $contest_id AND status = 1");
	if(count($contest_portfolios) < 12 && $contest->contest_level == '0')
	{
		$wpdb->update('mkd_contest', [
				'status' => 2
			], array('id' => $contest_id));
		return [
			'data' => 0,
			'message' => 'Number of users participating is not sufficient.'
		];exit();
	}
	else if(count($contest_portfolios) < 12)
	{
		$wpdb->insert('mkd_pods', array(
			'contest_id' => $contest->id,
			'contest_level' => 'final'
		));
		$pod_id = $wpdb->insert_id;
		foreach ($contest_portfolios as $key => $contest_portfolio) {
			$contest_user = $wpdb->get_results("SELECT  * FROM wp_users where ID = '$contest_portfolio->user_id'")[0];
			$email = $contest_user->user_email;
			$email_payload = array(
				'link' => site_url() . '/index.php/tournament/?contest_id='.$contest->id,
				'email' => $email,
				'round_number' => 'final'

			);
			$response = send_emails('next-round', $email_payload, $email);
			$wpdb->insert('mkd_pod_competitors', array(
				'pod_id' 		=> $pod_id,
				'contest_id' => $contest->id,
				'user_id'		=> $contest_portfolio->user_id,
				'portfolio_id' 	=> $contest_portfolio->portfolio_id,
				'contest_level' => 'final'
			));
		}
		$wpdb->update('mkd_contest', [
				'contest_level' => 'final'
			], array('id' => $contest_id));
		exit();

	}
	//$wpdb->query("UPDATE mkd_pod_competitors SET votes = votes + 1 WHERE portfolio_id = $competitor_id AND contest_level=$contest_level AND pod_id = $pod_id");
	// $pod_length = count($contest_portfolios) % 4;
	// for($i=0; $i <= $pod_size; $i++)
	// {
	// 	$wpdb->insert('mkd_pods', array(
	// 		'contest_id' => $contest->id
	// 	));
	// }

	$pod_size = 4;
	$chunked_arr= array_chunk($contest_portfolios, $pod_size);
	if(count($contest_portfolios) % 4 != '0')
	{
		$remaining_portfolios = $chunked_arr[count($chunked_arr) -1];
		foreach ($remaining_portfolios as $key => $remaining_portfolio) {
			array_push($chunked_arr[$key], $remaining_portfolio);
		}
		array_pop($chunked_arr);
	}
	foreach ($chunked_arr as $key => $chunked) {
		$wpdb->insert('mkd_pods', array(
			'contest_id' => $contest->id,
			'contest_level' => $contest_level+1
		));
		$pod_id = $wpdb->insert_id;
		foreach ($chunked as $key => $contest_portfolio) {			
			$contest_user = $wpdb->get_results("SELECT  * FROM wp_users where ID = '$contest_portfolio->user_id'")[0];
			$email = $contest_user->user_email;
			$email_payload = array(
				'link' => site_url() . '/index.php/tournament/?contest_id='.$contest->id,
				'email' => $email,
				'round_number' => $contest_level+1

			);
			$response = send_emails('next-round', $email_payload, $email);
			$wpdb->insert('mkd_pod_competitors', array(
				'pod_id' 		=> $pod_id,
				'contest_id' => $contest->id,
				'user_id'		=> $contest_portfolio->user_id,
				'portfolio_id' 	=> $contest_portfolio->portfolio_id,
				'contest_level' => $contest_level+1
			));
		}
	}
	$wpdb->update('mkd_contest', [
			'contest_level' => $contest_level+1
		], array('id' => $contest_id));
	exit();
}

function send_emails($slug, $payload, $email){
	global $wpdb;
	global $phpmailer;

	// (Re)create it, if it's gone missing
	if ( ! ( $phpmailer instanceof PHPMailer ) ) {
		require_once ABSPATH . WPINC . '/class-phpmailer.php';
		require_once ABSPATH . WPINC . '/class-smtp.php';
	}
	$phpmailer = new PHPMailer;

    $phpmailer->IsSMTP();
    $phpmailer->Host = 'smtp.sendgrid.net';
    $phpmailer->Port = '587';
    $phpmailer->SMTPSecure = 'tls';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Username = 'apikey';
    $phpmailer->Password = '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'; // password if gmail : manage account->security->allow less secure apps

    $phpmailer->addAddress($email);
    $phpmailer->setFrom('synysterdevil@gmail.com', 'Game Tournament');
    //$phpmailer->addReplyTo('info@example.com', 'Information');
    $phpmailer->isHTML(true);

	$template =   $wpdb->get_results("SELECT * FROM mkd_email_crud where slug = '$slug'")[0];
    $phpmailer->Subject = inject_substitutes($template->subject,$template->tag,$payload);
    $phpmailer->Body    = inject_substitutes($template->body,$template->tag,$payload);
    if(!$phpmailer->send()){
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $phpmailer->ErrorInfo;
	}else{
		echo 'Message has been sent';
	}
}

function inject_substitutes($raw, $tags, $data) 
{
	$tags = explode(',', $tags);
	foreach ($data as $key => $value) 
	{
		if (in_array($key, $tags))
		{
			$raw = str_replace('{{{' . $key . '}}}', $value, $raw);
		}
	}
	return $raw;
}