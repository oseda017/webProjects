<?php
	function loadLocalCSS(){
		$css_dir = scandir("s_folder");
		for($i = 0 ; $i < sizeof($css_dir) ; $i++){
			$split = explode(".",$css_dir[$i]);
			if($split[1] != "css"){
				continue;
			}else{
				print "<link />";
			}
		}
	}
	function setTitle($title = "Express Urgent Care"){
	?>
		<script type="text/javascript">
			document.title = "<?php print $title;?>";
		</script>
	<?php
	}
	if($con = mysql_connect("localhost","root","")){
		if(!mysql_select_db("express",$con)){
			print mysql_error();
		}
	}else{
		print mysql_error();
	}
	setTitle();
?>
<html>
	<head>
		<link rel="stylesheet" href="s_folder/gumby.css" />
		<link rel="stylesheet" href="s_folder/clinic.css" />
		<link rel="stylesheet" href="s_folder/semantic.min.css" />
		<link rel="stylesheet" href="s_folder/icon.min.css" />
		<link rel="stylesheet" href="s_folder/slick.css" />
		<script type="text/javascript" src="s_folder/0.js"></script>
		<script type="text/javascript" src="s_folder/slick.min.js"></script>
		<script type="text/javascript" src="s_folder/libs/gumby.js"></script>
		<script type="text/javascript" src="s_folder/libs/gumby.init.js"></script>
		<script type="text/javascript" src="s_folder/libs/modernizr-2.6.2.min.js"></script>
	</head>
	<body>
		<div class="bg_image_holder">
			
		</div>
		<div class="clinic_main row">
			<div class="row">
				<div class="twelve columns">
					<div class="ui inverted blue menu">
						<a class="item">
							<img class="ui image" src="s_folder/logo.jpg" />
						</a>
						<a href="/c/" class="item">
							<i class="ui home icon"></i>
							Home
						</a>
						<a href="/c/?express-nav=c_services" class="item">
							<i class="lab icon"></i>
							Clinic Services
						</a>
						<div class="right icon menu">
							<div class="item">
								<div class="ui inverted blue form segment">	
									<div class="ui mini icon input">
										<i class="search icon"></i>
											<input type="text" />
									</div>
								</div>
							</div>
							<a target="_blank" href="http://www.facebook.com" class="blue item"><i class="facebook large icon"></i></a>
							<a target="_blank" href="http://www.twitter.com" class="blue item"><i class="twitter large icon"></i></a>
							<a target="_blank" href="http://www.plus.google.com" class="blue item"><i class="google plus large icon"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="twelve columns">
					<div class="ui blue segment four columns clinic_seg_border_off">
						<h1 class="ui inverted header">
							Quality Urgent Care, Convenient & Fast.
						</h1>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="twelve columns">
					<div class="ui blue message four columns">
						<div class="ui header">
							Opening Hours <i class="wait icon"></i>
						</div>
						<div class="ui list">
							<a class="item">
								Mondays - Sundays  7:00 am - 8:00 pm
							</a>
						</div>
					</div>
						<div class="four columns"></div>
					<div class="ui blue segment four columns">
						<div class="ui blue fluid icon label clinic_auto_height">
							<i class="phone icon"></i>
								Contact US
						</div>
						<div class="ui list">
							<a class="item header">Call Us On 050 360 0855</a>
							<a class="item header">Email Us On info@<?php print $_SERVER["HTTP_HOST"]?></a>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="twelve columns">
					<?php
						if($_GET["express-nav"] == "c_services"){
							?>
								<div class="twelve columns">
									<div class="ui small teal message four columns">
										<div class="header">CLINIC SERVICES <i class="help icon"></i></div>
									</div>
								</div>
								<div class="twelve columns">
									<div class="ui divider"></div>
									<div class="ui blue segment clinic_seg_border_off">
										<div class="ui small blue message">
											At Express Urgent Care Clinic, we're here to give you quality, convenient care when you need it. We are able to treat most illnesses for both children and adults.
										</div>
										<div class="ui cards express_service_slider">
											<?php 
												$query_serv = "SELECT * FROM express_services";
												if($res = mysql_query($query_serv)){
													while($rows = mysql_fetch_array($res)){
														?>
															<div class="card clinic_white card_resp_height">
																<div class="image image_min_height">
																	<img src="s_folder/express_service_image/<?php print $rows["service_name"]?>.jpg" />
																</div>
																<div class="content">
																	<div class="header">
																		<?php print $rows["service_name"];?>
																	</div>
																	<div class="description">
																		<?php print substr($rows["service_description"],0,50) . "<a target='blank' href='/c/?express_service={$rows["service_name"]}'> ... Read More ... </a>";?>
																	</div>
																</div>
															</div>
														<?php
													}
												}
											?>
										</div>
										<script type="text/javascript">
											$(".express_service_slider").slick({
											  dots: true,
											  autoplay : true,
											  autoplaySpeed : 2000,
											  infinite: true,
											  speed: 300,
											  slidesToShow: 4,
											  slidesToScroll: 1,
											  responsive: [
												{
												  breakpoint: 1024,
												  settings: {
													slidesToShow: 3,
													slidesToScroll: 3,
													infinite: true,
													dots: true
												  }
												},
												{
												  breakpoint: 600,
												  settings: {
													slidesToShow: 2,
													slidesToScroll: 2
												  }
												},
												{
												  breakpoint: 480,
												  settings: {
													slidesToShow: 1,
													slidesToScroll: 1
												  }
												}
											  ]
											});
										</script>
									</div>
								</div>
							<?php
						}
						if(!empty($_GET["express_service"])){
							?>
								<div class="ui red image label clinic_auto_height">
									<img src="s_folder/express_service_image/<?php print $_GET['express_service']?>.jpg" />
										<?php print $_GET["express_service"]?>
								</div>
								<div class="ui divider"></div>
							<?php
							print "<div class='ui blue segment'>";
							print "<div class='ui divided items'>";
							setTitle("Express Urgent Care | " . $_GET["express_service"]);
							$query_menu = "SELECT * FROM services_menu WHERE service_name = '{$_GET['express_service']}'";
							if($res = mysql_query($query_menu)){
								while($rows = mysql_fetch_array($res)){
									?>
										<div class="item">
											<a class="ui tiny image">
												<img src="s_folder/express_service_image/<?php print $rows['menu_name']?>.jpg" />
											</a>
											<div class="content">
												<a href="/c/?services=<?php print $rows['service_name']?>&read_more=<?php print $rows['menu_name']?>" class="header"><?php print $rows["menu_name"]?></a>
												<div class="description fluid">
													<?php print substr($rows["menu_description"],0,200)?> <a href="/c/?services=<?php print $rows['service_name']?>&read_more=<?php print $rows['menu_name']?>" > ... Read More ... </a>
												</div>
											</div>
										</div>
									<?php
								}
							}
							print "</div>";
							print "</div>";
						}
						if(!empty($_GET["services"]) && !empty($_GET["read_more"])){
							$query_read = "SELECT * FROM services_menu WHERE service_name = '{$_GET['services']}' AND menu_name = '{$_GET['read_more']}'";
							if($res = mysql_query($query_read)){
								if($row = mysql_fetch_array($res)){
									?>
										<div class="divider"></div>
										<div class="ui fluid card">
											<div class="image">
												<img class="ui large image" src="s_folder/express_service_image/<?php print $row['menu_name']?>.jpg" />
											</div>
											<div class="content">
												<div class="header">
													<?php print $row['menu_name']?>
												</div>
												<div class="description">
													<?php print $row['menu_description']?>
												</div>
											</div>
										</div>
									<?php
								}
							}
						}
					?>
				</div>
			</div>
		</div>
			<?php
				$spliter = explode('?',$_SERVER["REQUEST_URI"]);
				if(sizeof($spliter) <= 1){
					$spliter = explode('?',$_SERVER["REQUEST_URI"]);
						print "<div class='ui divider'></div>";
						print "<div class='ui blue segment clinic_home_slider'>";
							$query_slider = "SELECT * FROM express_slider";
							if($res = mysql_query($query_slider)){
								while($rows = mysql_fetch_array($res)){
									?>
										<div class="clinic_slider_height" style="background:url('s_folder/slides_image/<?php print $rows["slider_name"]?>.jpg');background-repeat:no-repeat;background-size:cover;" class="ui fluid segment">
											<div class="row">
												<div class="twelve columns">
													<div class="four columns"></div>
													<div class="four columns"></div>
													<div class="ui blue message four columns">
														<h1 class="ui header">
															<?php print $rows["slider_text"]?>
															<a href=""><i class="chevron circle right icon">...</i></a>
														</h1>
													</div>
												</div>
											</div>
										</div>
									<?php
								}
							}
						print "</div>";
					?>
						<script type="text/javascript">
							$(".clinic_home_slider").slick({
								autoplay : true,
								autoplaySpeed : 3000,
								fade : true,
								cssEase : 'linear'
							});
						</script>
				<div class='ui divider'></div>
			<div class="row">
						<div class="twelve columns">
							<div class="ui inverted blue stacked segment twelve columns">
								<div class="ui three cards">
									<div class="card">
										<div class="image">
											<img src="s_folder/express_service_image/Healthy Leaving.jpg" />
										</div>
										<div class="content">
											<a class="header">
												Healthy Leaving ...
											</a>
											<div class="description">
												Tips to help you foster a healthy body, mind, and emotions.
											</div>
										</div>
									</div>
									<div class="card">
										<div class="image">
											<img src="s_folder/express_service_image/Health Line.jpg" />
										</div>
										<div class="content">
											<a class="header">
												Health Line ...
											</a>
											<div class="description">
												Twenty-four hours a day, seven days a week, Express Urgent Care HealthLine delivers answers to your health-related questions.
											</div>
										</div>
									</div>
									<div class="card">
										<div class="image">
											<img src="s_folder/express_service_image/clinic services.jpg" />
										</div>
										<div class="content">
											<a href="/c/?express-nav=c_services" class="header">
												Clinic Services ...
											</a>
											<div class="description">
												Health information from our Healthwise Library - which provides comprehensive health information on thousands of health topics. It includes information on illnesses ,conditions and medications.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
			</div>
			<?php } ?>
				<div class='ui divider'></div>
		<div class="row footer">
			<div class="ui inverted black message">
				<div class="ui inverted black horizontal link list">
					<a class="item">© 2015 Express Urgent Care. All rights reserved.</a>
					<a class="item">Send Feedback</a>
				</div>
			</div>
		</div>
	</body>
</html>