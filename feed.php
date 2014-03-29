<?php 

	error_reporting(0);

	function registerCurl($cmd) {
        exec($cmd,$result);
        //var_dump($result);
        $data = json_decode($result[0]);
        return $data;
	}

	function registerCurlFacebook($cmd) {
        exec($cmd,$result);
        $data = json_decode(substr($result[0],9));
        return $data;
	}

	function registerCurlGodaddy($cmd) {
        exec($cmd,$result);
        return $result;
	}

	function registerCurlHtml($cmd) {
        exec($cmd,$result);
        return $result;
	}
	
	
	/*GLOBAL FUNCTIONS
	************************************************************************/

	function findUsername($username) {
		$sites = array();
		if(findUsernameGoogle($username)) {
			$sites["google"]=array(
				"name"=>"Google",
				"description"=>"",
				"imgURL"=>"http://quickscreen.me/css/chrome.jpg",
				"link"=>"https://mail.google.com",
				"email"=>NULL,
				"username"=>$username,
			);
			
		}
		if(findUsernameGodaddy($username)) {
			$sites["godaddy"]=array(
				"name"=>"Go Daddy",
				"description"=>"",
				"imgURL"=>"http://freeasp.net/wp-content/uploads/2014/03/godaddy-reseller.png",
				"link"=>"http://www.godaddy.com/",
				"email"=>NULL,
				"username"=>$username,
			);
			
		}
		if(findUsernameMatch($username)) {
			$sites["match"]=array(
				"name"=>"Match.com",
				"description"=>"",
				"imgURL"=>"http://www.letmypeoplego.com/images/location/match_logo.jpg",
				"link"=>"http://www.match.com/",
				"email"=>NULL,
				"username"=>$username,
			);
			
		}
		
		return $sites;
	}
	
	function findEMail($email) {
		$sites = array();
		if(findEmailBox($email)) {
			$sites["box"]=array(
				"name"=>"Box",
				"description"=>"",
				"imgURL"=>"http://cloudtimes.org/wp-content/uploads/2011/08/box_logo.png",
				"link"=>"https://www.box.com/",
				"email"=>$email,
				"username"=>NULL,
			);
			
		}
		if(findEmailEbay($email)) {
			$sites["ebay"]=array(
				"name"=>"Ebay",
				"description"=>"",
				"imgURL"=>"http://techblog.weblineindia.com/wp-content/uploads/2012/09/eBay-Logo-New-300x225.jpg",
				"link"=>"https://www.ebay.com/",
				"email"=>$email,
				"username"=>NULL,
			);
			
		}
		if(findEmailFacebook($email)) {
			$sites["facebook"]=array(
				"name"=>"Facebook",
				"description"=>"",
				"imgURL"=>"https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcQYuCbsmPLvmpWObmvCFxckWSM7itG2h80chjRXuelSGTIIXvIl",
				"link"=>"https://www.facebook.com/",
				"email"=>$email,
				"username"=>NULL,
			);
			
		}
		if(findEmailFoursquare($email)) {
			$sites["foursquare"]=array(
				"name"=>"Foursquare",
				"description"=>"",
				"imgURL"=>"http://upload.wikimedia.org/wikipedia/commons/5/5b/Foursquare-logo.png",
				"link"=>"https://www.foursquare.com/",
				"email"=>$email,
				"username"=>NULL,
			);
			
		}
		if(findEmailLinkedin($email)) {
			$sites["linkedin"]=array(
				"name"=>"LinkedIn",
				"description"=>"",
				"imgURL"=>"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQbK22ILwVlu_hipCtEU2rhJ7b9mio_tgTcAaLJVjSUmmrFXrH2hQ",
				"link"=>"https://www.linkedin.com/",
				"email"=>$email,
				"username"=>NULL,
			);
			
		}
		if(findEmailMatch($email)) {
			$sites["match"]=array(
				"name"=>"Match",
				"description"=>"",
				"imgURL"=>"http://www.letmypeoplego.com/images/location/match_logo.jpg",
				"link"=>"https://www.match.com/",
				"email"=>$email,
				"username"=>NULL,
			);
			
		}
		return $sites;
	}
	
	
	/*USERNAME FUNCTIONS
	************************************************************************/

	function findUsernameGoogle($username) {
		$data = registerCurl("curl 'https://accounts.google.com/InputValidator?resource=SignUp' -H 'content-type: application/json'   --data-binary '{\"input01\":{\"Input\":\"GmailAddress\",\"GmailAddress\":\"$username\",\"FirstName\":\"\",\"LastName\":\"\"},\"Locale\":\"en\"}'");
        return ($data->input01->Valid == "false");
	}

	function findUsernameGodaddy($username) {
		$data = registerCurl("curl 'https://idp.godaddy.com/create/validateusername.aspx?idpXdReq=true' -H 'Pragma: no-cache' -H 'Origin: http://www.godaddy.com' -H 'Accept-Encoding: gzip,deflate,sdch' -H 'Accept-Language: en-US,en;q=0.8' -H 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.152 Safari/537.36' -H 'Content-Type: application/x-www-form-urlencoded' -H 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8' -H 'Cache-Control: no-cache' -H 'Referer: http://www.godaddy.com/' -H 'Cookie: countrysite1=WWW; language1=en-US; vistorpromo1=firsttime; SplitValue1=45; preferences=currency=USD; preferences1=_sid=&gdshop_currencyType=USD; PCSplitValue1=2; pathway=ea8c9157-8c35-440c-b5a3-c7540dc361fb; optimizelySegments=%7B%22172584383%22%3A%22direct%22%2C%22172648668%22%3A%22false%22%2C%22172669289%22%3A%22none%22%2C%22172690147%22%3A%22gc%22%7D; optimizelyEndUserId=oeu1396064731462r0.5025915263686329; optimizelyBuckets=%7B%22125723167%22%3A%22125705946%22%7D; fbiTrafficSettings=cDepth=24&resX=1440&resY=900&fMajorVer=-1&fMinorVer=-1&slMajorVer=-1&slMinorVer=-1; __utma=247200914.1668783098.1396064732.1396064732.1396064732.1; __utmb=247200914.1.10.1396064732; __utmc=247200914; __utmz=247200914.1396064732.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none); utag_main=_st:1396066532102$ses_id:1396065599497%3Bexp-session$transaction_id:undefined%3Bexp-session$homepage_us:true%3Bexp-1398656732330$yahooRemarketing:true%3Bexp-1398656732331; cvo_sid1=MBME6BXDCB64; cvo_tid1=BnTHCZLrPGI|1396064732|1396064732|0; ATL.SID.IDP=HbKJxt8JEX7nM%2bUuwuW3YL1gcNIWHRbHyg80LzsJxnc%3d; gdCassCluster.JqKUTxBOga=7; pagecount=2; fb_sessionpagecount=2; actioncount=; fb_actioncount=; app_pathway=; fb_sessiontraffic=S_TOUCH=03/29/2014%2003:45:39&pathway=ea8c9157-8c35-440c-b5a3-c7540dc361fb&V_DATE=03/28/2014%2020:45:31; visitor=vid=ea8c9157-8c35-440c-b5a3-c7540dc361fb; traffic=' -H 'Connection: keep-alive' --data 'hdnUsername=$username' --compressed
");
		$data = registerCurlGodaddy("curl 'https://idp.godaddy.com/create/validateusername.aspx?idpXdReq=true&callback=jQuery18006959630101919174_1396064731369&GetResults=true&_=1396064821293' -H 'Pragma: no-cache' -H 'Accept-Encoding: gzip,deflate,sdch' -H 'Accept-Language: en-US,en;q=0.8' -H 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.152 Safari/537.36' -H 'Accept: */*' -H 'Referer: http://www.godaddy.com/' -H 'Cookie: countrysite1=WWW; language1=en-US; vistorpromo1=firsttime; SplitValue1=45; preferences=currency=USD; preferences1=_sid=&gdshop_currencyType=USD; PCSplitValue1=2; pathway=ea8c9157-8c35-440c-b5a3-c7540dc361fb; optimizelySegments=%7B%22172584383%22%3A%22direct%22%2C%22172648668%22%3A%22false%22%2C%22172669289%22%3A%22none%22%2C%22172690147%22%3A%22gc%22%7D; optimizelyEndUserId=oeu1396064731462r0.5025915263686329; optimizelyBuckets=%7B%22125723167%22%3A%22125705946%22%7D; fbiTrafficSettings=cDepth=24&resX=1440&resY=900&fMajorVer=-1&fMinorVer=-1&slMajorVer=-1&slMinorVer=-1; __utma=247200914.1668783098.1396064732.1396064732.1396064732.1; __utmb=247200914.1.10.1396064732; __utmc=247200914; __utmz=247200914.1396064732.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none); utag_main=_st:1396066532102$ses_id:1396065599497%3Bexp-session$transaction_id:undefined%3Bexp-session$homepage_us:true%3Bexp-1398656732330$yahooRemarketing:true%3Bexp-1398656732331; cvo_sid1=MBME6BXDCB64; cvo_tid1=BnTHCZLrPGI|1396064732|1396064732|0; ATL.SID.IDP=HbKJxt8JEX7nM%2bUuwuW3YL1gcNIWHRbHyg80LzsJxnc%3d; gdCassCluster.JqKUTxBOga=7; pagecount=2; fb_sessionpagecount=2; actioncount=; fb_actioncount=; app_pathway=; fb_sessiontraffic=S_TOUCH=03/29/2014%2003:45:39&pathway=ea8c9157-8c35-440c-b5a3-c7540dc361fb&V_DATE=03/28/2014%2020:45:31; visitor=vid=ea8c9157-8c35-440c-b5a3-c7540dc361fb; traffic=' -H 'Connection: keep-alive' -H 'Cache-Control: no-cache' --compressed");
		return (strpos($data[0],'"IsValid":false') !== false);
	}
	
	function findUsernameMatch($username) {
		$data = registerCurl("curl 'http://www.match.com/rest/MainService.ashx/Register' -H 'Pragma: no-cache' -H 'Origin: http://www.match.com' -H 'Accept-Encoding: gzip,deflate,sdch' -H 'Accept-Language: en-US,en;q=0.8' -H 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.152 Safari/537.36' -H 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8' -H 'Accept: application/json, text/javascript, */*; q=0.01' -H 'Cache-Control: no-cache' -H 'X-Requested-With: XMLHttpRequest' -H 'Cookie: PrefID=183-26412479; CSList=1088370/8263767,1088370/8263767,1088370/8263767,0/0,0/0; __s2m_sid_1173=UCZxeWeC5VlC6cv7NkGBuzNIiCkDdDRi; __s2m_stid_1173=1396067689664; __s2m_pid_1173=86f23a50b6d4c92d3854536571a52a17; __s2m_vals_1173=XV2PCOtpqf0i4aCt4bM1Re9qaY4SXixy; Match=CCount=1&CDate=3/28/2014; dMatch=CCount=1&CDate=3/28/2014; MatchSession=CDTF=3/28/2014&UMID=ad71f964-e1b3-4d97-b1be-85f13935caa8; SECU=TID=0&ESID=eb1f5e8f-ea3d-40ef-a35d-dcc706d0c731&THEME=251; Mat_mkt=fvs=3/28/2014&lvs=3/28/2014&mgen=2&gsk=1&agsk=2; PinStore=-1107996198=-996929428|0; OLN=OLNVAL=0&AFCVAL=0; MatchSearchROF=ROF01=&ROF05=&ROF02=&ROF04=&ROF03=&ROF06=; dMatchSearchROF=ROF01=&ROF05=&ROF02=&ROF04=&ROF03=&ROF06=; dMatchSearch=SC01=1&SC02=1&SC07=0&SC08=75230&SC13=0&SC14=0&SC09=1&SC03=21&SC04=40; MatchSearch=SC08=75230&SC08a=&SC11=&SC01=1&SC02=1&SC07=0&SC13=0&SC14=0&SC09=1&SC03=21&SC04=40; __utma=191932533.921712207.1396067758.1396067758.1396067758.1; __utmb=191932533.4.10.1396067758; __utmc=191932533; __utmz=191932533.1396067758.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none)' -H 'Connection: keep-alive' -H 'Referer: http://www.match.com/search/searchSubmit.aspx?r2s=1&cpp=cppp/floatingreg%2findex%2fdefault.html&q=man,men,21,40,2975443567&st=quicksearch&pn=1&rn=4&do=2' --data 'sid=eb1f5e8f-ea3d-40ef-a35d-dcc706d0c731&theme=251&handle=$username&autoGenHandle=false&password=Marimba1&email=asdfasdfasdfasdf%40smu.edu&birthDay=18&birthMonth=4&birthYear=1992&postalCode=75230&countryCode=1&stateCode=0&cityCode=0&gender=1&genderSeek=1&phoneAreaCode=&phoneNumber=&emailMatchInfo=true&emailNewsOffers=false&emailVenusmatches=false&emailPartners=false&platinumContact=false&pageID=cppp%2Ffloatingreg%2Findex%2Fdefault.html&pageVersion=1' --compressed");
		
        return (strpos($data->Messages[0]->Text,'The username you selected is already in use') !== false);
	}
	
	
	
	
	
	/*EMAIL FUNCTIONS
	************************************************************************/

	function findEmailBox($email) {
		$data = registerCurl("curl 'https://app.box.com/index.php?rm=signup_check_email' -H 'Cookie: z=aa3d3orj7h4si94enidqht0ea6;' --data 'email=$email&request_token=a6d69cba4de5f0062bbd7e02c0a8fd448cf489b2032170e61085cf4f1e7065ae&' --compressed");
        return ($data->email_registered);
	}

	function findEmailEbay($email) {
		$data = registerCurl("curl 'https://reg.ebay.com/reg/ajax' --data 'email=$email&countryId=1&mode=5&eId=email'");
        return (strpos($data->content->email,'Your email address is already registered with eBay') !== false);
	}

	function findEmailFacebook($email) {
		$data = registerCurlFacebook("curl 'https://www.facebook.com/ajax/register.php'  -H 'cookie: datr=ujwvUo6p-8ZMtlVL4zlJrNad;' --data 'lsd=AVr3v4kJ&firstname=asdf&lastname=asdf&reg_email__=$email&reg_email_confirmation__=$email&reg_passwd__=asdf&birthday_month=1&birthday_day=1&birthday_year=1905&sex=2&referrer=&asked_to_login=0&terms=on&ab_test_data=PA33%2FXPAnHAHHAHPAAAAAAHAHAAAAAAAAAAAAAAAavv%2FkvKVAFWBBF&contactpoint_label=email_only&locale=en_US&abtest_registration_group=1&reg_instance=ujwvUo6p-8ZMtlVL4zlJrNad&captcha_persist_data=AZlFzNV6qj2y2-iteuNikiH7EVzKy27Yl0L8U5Z6FtPML3cSQjyEC88jIh--6yCHeVmfImT5Ioqv9hvvtxFFo7HsToclViFd9PoLAD7yZ2E9qrByDz7IrjRE64VHY-MDA1GflGplThFMGgS05DkpU2Gs0NIJs8e48IZr8PXzT2YjyyDupiuUDJIInyzJRVJWRZMnMj1eB7dP8UlcdVscrN6mq9XlKNi7IorPEnk40lx0Ect-lST2f-BY3Rxa4dGsTmjS41ahwjKOSGZYVEtXGJeE6qJU7OylB_A1fMdTmppgBZVCvaR6GJMExItOfETa-zaRzcdAcVGH_5Racal8kT5ugvT_sjjuwFQOHOn5y1qp7A&captcha_session=vLD7rhMnQ7l-o_svm2q1lg&extra_challenge_params=authp%3Dnonce.tt.time.new_audio_default%26psig%3DSB2UyyGF_0bVWhnUgmJyZ26fvfw%26nonce%3DvLD7rhMnQ7l-o_svm2q1lg%26tt%3Dp6gtvvdGftAqMpfRv4n2K_goOT0%26time%3D1396054796%26new_audio_default%3D1&recaptcha_type=password&captcha_response=&ignore=captcha%7Cpc&__user=0&__a=1&__dyn=7wiXwNAwsUKEkzoynFw&__req=f&__rev=1183274' --compressed");
        return $data->payload->error_plain == "There is an existing account associated with this email.";
	}

	function findEmailFoursquare($email) {
		$data = registerCurl("curl 'https://api.foursquare.com/v2/users/lookup?locale=en&explicit-lang=false&v=20140328&email=$email&wsid=YCSVUFPA1PKVM2TIUJR2XXYKCKKQV5&oauth_token=QEJ4AQPTMMNB413HGNZ5YDMJSHTOHZHMLZCAQCCLXIX41OMP'");
        return !($data->meta->code == 400);
	}

	function findEmailLinkedin($email) {
		$data = registerCurl("curl 'https://www.linkedin.com/reg/join-create' -H 'Cookie: bcookie=\"v=2&560cca6f-0bb3-450a-8ab5-f4c832002215\"; bscookie=\"v=1&2013091123392605f91c76-111b-41d0-877c-5d7433ac9668AQH0_DxPcyHCVGnEKx_1pBgJmOZGKWZY\"; __qca=P0-1774545782-1381852161442; visit=\"v=1&M\; _leo_profile=\"\"; X-ATS-Node-0=0; X-ATS-Node-1=0; X-ATS-Node-2=0; _lipt=\"0_Ug0Qv7FkXOSizDNxneHDbvup8kBiPB4dwimQHUw1zRmM_8v-xS5tALaJgwSxztijpE9yy8gSK4O34LrNCgw8JhvNYiOlBQVlF8lq1kCi1Sph-ekvVkAiWL0dA5JvXo-HRYXY4H9cwBVpB6q7KqOdqj0OElBKok_--Y92zkoQdrcKLbyPSniIWvG8zsnJX35e4f0UL-miLVBlehq0R0yu5aNNXgGyFBi_BLkUQJGH05p0AdCE4QFy-3GEEqAoIacFFKIcwD_bjQA_pqXxU96pjlY8EEqKNpLs7SbKoN5_oFfsIMPWa1DxthWaXC3Re5Z_\"; _cb_ls=1; _chartbeat2=Cqj3/YCDdlomD3/oe.1396035957964.1396035957964.1; _chartbeat_uuniq=3; lihc_auth_en=1396066664; JSESSIONID=\"ajax:6415264161769157566\"; lidc=\"b=LB57:g=76:u=1:i=1396066665:t=1396153065:s=3771025559\"; L1e=203e6005; RT=s=1396066672132&r=https%3A%2F%2Fwww.linkedin.com%2Fuas%2Flogin%3Fsession_redirect%3Dhttp%253A%252F%252Fhelp.linkedin.com%252Fapp%252Fhome%252Freauth%252Ftrue; leo_auth_token=\"GST:9VeMhuG45Fh1f3dG2c6VsBuM1Jvu2S6ajG2iP2G-hZhP3XsOdIDVQi:1396066696:9f2784ea19ee6339795ce8ab22daffc71b478cea\"; lang=\"v=2&lang=en-us\"; __utma=23068709.374424338.1396066670.1396066670.1396066670.1; __utmb=23068709.6.10.1396066670; __utmc=23068709; __utmz=23068709.1396066670.1.1.utmcsr=help.linkedin.com|utmccn=(referral)|utmcmd=referral|utmcct=/; __utmv=23068709.guest' -H 'Origin: https://www.linkedin.com' -H 'X-LinkedIn-traceDataContext: X-LI-ORIGIN-UUID=4LEmpEPTXxPQJnTsQysAAA==' -H 'Accept-Language: en-US,en;q=0.8' -H 'X-Requested-With: XMLHttpRequest' -H 'X-IsAJAXForm: 1' -H 'Accept-Encoding: gzip,deflate,sdch' -H 'Connection: keep-alive' -H 'Pragma: no-cache' -H 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.152 Safari/537.36' -H 'Content-Type: application/x-www-form-urlencoded' -H 'Accept: */*' -H 'Cache-Control: no-cache' -H 'Referer: https://www.linkedin.com/reg/join' --data 'isJsEnabled=true&firstName=Matthew&lastName=Bolanos&email=$email&password=asdfasdfasdf&webmailImport=true&trcode=&genie-reg=&mod=&key=&authToken=&authType=&csrfToken=ajax%3A6415264161769157566&sourceAlias=0_0pKtnXJ9l1BopHQS-IqS2t&client_ts=1396066704686&client_r=mbolanos%40smu.edu%3A820433535%3A277140802%3A543929743&client_output=-221072856&client_n=820433535%3A277140802%3A543929743&client_v=1.0.1' --compressed");
		return (strpos($data->errors->fieldErrors->{'email-coldRegistrationForm'},'is already registered') !== false);
	}

	function findEmailMatch($email) {
		$data = registerCurl("curl 'http://www.match.com/rest/MainService.ashx/ValidatePartialRegistration' -H 'Pragma: no-cache' -H 'Origin: http://www.match.com' -H 'Accept-Encoding: gzip,deflate,sdch' -H 'Accept-Language: en-US,en;q=0.8' -H 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.152 Safari/537.36' -H 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8' -H 'Accept: application/json, text/javascript, */*; q=0.01' -H 'Cache-Control: no-cache' -H 'X-Requested-With: XMLHttpRequest' -H 'Cookie: PrefID=183-26412479; CSList=1088370/8263767,1088370/8263767,1088370/8263767,0/0,0/0; __s2m_sid_1173=UCZxeWeC5VlC6cv7NkGBuzNIiCkDdDRi; __s2m_stid_1173=1396067689664; __s2m_pid_1173=86f23a50b6d4c92d3854536571a52a17; __s2m_vals_1173=XV2PCOtpqf0i4aCt4bM1Re9qaY4SXixy; Match=CCount=1&CDate=3/28/2014; dMatch=CCount=1&CDate=3/28/2014; MatchSession=CDTF=3/28/2014&UMID=ad71f964-e1b3-4d97-b1be-85f13935caa8; SECU=TID=0&ESID=eb1f5e8f-ea3d-40ef-a35d-dcc706d0c731&THEME=251; Mat_mkt=fvs=3/28/2014&lvs=3/28/2014&mgen=2&gsk=1&agsk=2; PinStore=-1107996198=-996929428|0; dMatchSearch=SC01=1&SC02=1&SC07=0&SC08=75230&SC13=0&SC14=0&SC09=1&SC03=21&SC04=40; OLN=OLNVAL=0&AFCVAL=0; MatchSearchROF=ROF01=&ROF05=&ROF02=&ROF04=&ROF03=&ROF06=; dMatchSearchROF=ROF01=&ROF05=&ROF02=&ROF04=&ROF03=&ROF06=; MatchSearch=SC08=75230&SC08a=&SC11=&SC01=1&SC02=1&SC07=0&SC13=0&SC14=0&SC09=1&SC03=21&SC04=40; __utma=191932533.921712207.1396067758.1396067758.1396067758.1; __utmb=191932533.6.10.1396067758; __utmc=191932533; __utmz=191932533.1396067758.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none)' -H 'Connection: keep-alive' -H 'Referer: http://www.match.com/search/searchSubmit.aspx?r2s=1&cpp=cppp/floatingreg%2findex%2fdefault.html&q=man,men,21,40,2975443567&st=quicksearch&pn=1&rn=4&do=2' --data 'sid=eb1f5e8f-ea3d-40ef-a35d-dcc706d0c731&theme=251&handle=&password=asdfasdfasdf&email=$email&birthDay=18&birthMonth=1&birthYear=1992&postalCode=75230&countryCode=1&stateCode=0&cityCode=0&gender=1&genderSeek=1&ageSeekLow=21&ageSeekHigh=40&phoneAreaCode=&phoneNumber=&emailMatchInfo=true' --compressed");
		return (strpos($data->Messages[0]->Text,'The email address you entered cannot be used to register') !== false);
	}
	
	
	
	/*START OF MAIN
	************************************************************************/
	
	/*$sites = array();
	
	foreach($_POST["emails"] as $email) {
		$sites = array_merge($sites,findEmail($email));
	}
	
	foreach($_POST["usernames"] as $username) {
		$sites = array_merge($sites,findUsername($username));
	}
	
	echo json_encode($sites);*/
	
	//echo json_encode(findUsername("hotguy"));
	echo json_encode(array_merge(findEmail("mbolanos@smu.edu"),findUsername("hotguy")));
        
?>


