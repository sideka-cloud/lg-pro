<?php
if (file_exists('LookingGlass/Config.php')) {
    require 'LookingGlass/Config.php';
    if (!isset($ipv4, $ipv6, $siteName, $siteUrl, $serverLocation, $testFiles, $theme)) {
    exit('Configuration variable/s missing. Please run configure.sh');
    }
} else {
    exit('Config.php does not exist. Please run configure.sh');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <title><?php echo $siteName; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="LookingGlass - Open source PHP looking glass">
    <meta name="author" content="Telephone">

    <link href="assets/css/<?php echo $theme; ?>.min.css" rel="stylesheet">

    </head>
<body>
<div class="container">
    <header class="header nohighlight" id="overview">
        <div class="row">
            <div class="span12">
                <h1><a id="title" href="<?php echo $siteUrl; ?>"><?php echo $siteName; ?></a></h1>
            </div>
        </div>
    </header>

    <section id="information">
        <div class="row">
            <div class="span12">
            <div class="well">
                <span id="legend">Network information</span>
                <p>Server Location: <b><?php echo $serverLocation; ?></b></p>
                <div style="margin-left: 10px;"></div>
                <p>Your IP Address: <b><a href="" id="userip"><?php echo $_SERVER['REMOTE_ADDR']; ?></a></b></p>
            </div>
            </div>
        </div>
    </section>

    <section id="tests">
        <div class="row">
            <div class="span12">
            <form class="well form-inline" id="networktest"  method="post">
                <fieldset>
                <span id="legend">Network Tests</span>
                <div id="hosterror" class="control-group">
                    <div class="controls">
                    <input id="host" name="host" type="text" class="input-large" placeholder="Domain or IP address">
                </div>
                </div>
                <select name="cmd" class="input-medium" style="margin-left: 5px;">
                    <option value="host">host</option>
                    <option value="mtr">mtr</option>
                    <?php if (!empty($ipv6)) { echo '<option value="mtr6">mtr6</option>'; } ?>
                    <option value="ping" selected="selected">ping</option>
                    <?php if (!empty($ipv6)) { echo '<option value="ping6">ping6</option>'; } ?>
                    <option value="traceroute">traceroute</option>
                    <?php if (!empty($ipv6)) { echo '<option value="traceroute6">traceroute6</option>'; } ?>
                </select>
                <button type="submit" id="submit" name="submit" class="btn btn-primary" style="margin-left: 10px;">Run Test</button>
                </fieldset> </br><pre id="response" style="display:none"></pre>
            </form>
            </div>
        </div>
    </section>

    <section id="tests">
        <div class="row">
            <div class="span12">
            <form class="well form-inline" id="networktest"  method="post">
                <fieldset>
                    <span id="legend">Ports Scan All in One</span>
                    <input name="ipdomain" type="text" class="input-large" placeholder="Domain or IP address">
                    <button type="submit" id="submit" name="submit" class="btn btn-primary" style="margin-left: 10px;">Scan Port</button>
                </fieldset>
                <br />
                <?php
                    if(!empty($_POST['ipdomain'])) {
                        //list of port numbers to scan
                        $ports = array(20,21,22,23,25,26,37,43,47,49,53,80,81,88,110,111,113,123,135,137,138,139,143,161,162,220,222,280,389,443,445,465,480,
                    500,514,587,636,783,801,808,873,989,990,993,995,1022,1023,1025,1080,1194,1433,1521,1701,1723,2002,2022,2077,2078,2080,2083,2087,2095,2096,2220,
                    2280,2222,2375,2376,2377,2379,2380,2525,2580,3000,3001,3010,3030,3080,3128,3268,3306,3307,3380,3389,3399,3443,4500,4789,5000,5080,5222,5223,5432,
                    5617,5800,5900,5901,5980,6001,6080,6443,6379,7025,7047,7071,7072,7080,7110,7143,7171,7306,7946,7993,7995,7946,8000,8001,8002,8006,8007,8022,8025,
                    8080,8081,8083,8088,8089,8090,8288,8443,8447,8465,8472,8765,8891,8888,9020,9071,9080,9090,9100,10000,10025,10029,10080,10250,10251,10252,10255,27017,);

                        $results = array();
                        foreach($ports as $port) {
                            if($pf = @fsockopen($_POST['ipdomain'], $port, $err, $err_string, 1)) {
                                $results[$port] = true;
                                fclose($pf);
                            } else {
                                $results[$port] = false;
                            }
                        }

                    echo "Scanning Result for :<strong> ", $_POST['ipdomain'], "</strong><br/><br/>"; 
                        foreach($results as $port=>$val)    {
                            $prot = getservbyport($port,"tcp");

                            if($val) {
                                echo "<strong>Port $port ($prot): <span style=\"color:green\">!|!*****!! OPEN !!*****!|!</strong></span><br/>";
                            }
                            else {
                                echo "Port $port ($prot): <span style=\"color:red\">CLOSED</span><br/>";
                            }
                        }
                    }
                ?>
            </form>
            </div>
        </div>
    </section>

    <section id="tests">
        <div class="row">
            <div class="span12">
            <form class="well form-inline" id="networktest"  method="post">
                <fieldset>
                    <span id="legend">Port Scan Specific</span>
                    <div id="hosterror" class="control-group">
                        <div class="controls">
                            <input id="ip" name="ip" type="text" class="input-large" placeholder="Domain or IP address">
                            <input id="port" name="port" type="text" class="input-large" placeholder="Port Number">
                        </div>
                    </div>
                        <button type="submit" id="submit" name="submit" class="btn btn-primary" style="margin-left: 10px;">Scan Port</button>
                </fieldset>
                <?php
                if (isset($_POST['submit'])) {
                    scan();
                }
                function scan(){
                    $ip = $_POST['ip'];
                    $port = $_POST['port'];

                    if (empty($ip) || empty($port)){
                    echo "</br>";
                    }  else {

                    $fp = fsockopen($ip, $port, $errno, $errstr, 1);
                    if($fp){
                        echo '</br> <strong><font color=orange>Port '.$port.' </strong></font> on
                        <font color=blue> '.$ip.' </font> is <strong><font color=green> OPEN';
                    } else {
                        echo '</br> <strong><font color=orange>Port '.$port.' </strong></font> on
                        <font color=blue> '.$ip.' </font> is  <strong><font color=red> CLOSED';
                    }
                    }
                }
                ?>
            </form>
            </div>
        </div>
    </section>

	<section id="tests">
        <div class="row">
            <div class="span12">
                <form id="lookup-form" class="well form-inline" method="post">
                <fieldset>
                    <span id="legend">Whois Lookup</span>
                        <div id="hosterror" class="control-group">
                        <div class="controls">
                            <input type="text" class="form-control" id="domain" name="domain" placeholder="Domain or IP address">  
                            <button type="button" class="btn btn-primary mt-3 float-left" id="get-lookup" name="submit" style="margin-left: 10px;"><i class="fa fa-search"></i> Whois Lookup</button>     
                        </div>
                        </div>
                </fieldset>
                </br>
                    <span id="lookup-dispaly-details"></span>
                </form>
            </div>
        </div>
    </section>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        jQuery(document).on('click', 'button#get-lookup', function(){
            jQuery.ajax({
                type:'POST',
                url:'lookup.php',
                data:jQuery("form#lookup-form").serialize(),
                dataType:'html',
                beforeSend: function () {
                    jQuery('button#get-lookup').button('loading');
                    jQuery('span#lookup-dispaly-details').html('<i class="fa fa-spinner" style="font-size:30px;"></i>');
                },
                complete: function () {
                    jQuery('button#get-lookup').button('reset');
                },
                success: function (html) {
                    jQuery('span#lookup-dispaly-details').html(html);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        });
    </script>      

    <section id="tests">
        <div class="row">
            <div class="span12">
            <form class="well form-inline" id="networktest" method="post">
                <fieldset>
                <span id="legend">DNS Record</span>
                <div id="hosterror" class="control-group">
                    <div class="controls">
                    <input id="dns" name="dns" type="text" class="input-large" placeholder="Domain">
                </div>
                </div>
                    <button type="submit" id="submit" name="submit" class="btn btn-primary" style="margin-left: 10px;">Scan Record</button>
                </fieldset>
                <?php 
                $domainhost= $_POST['dns']; 
                echo "</br>"; 
                    single_type_dns_get_record($domainhost, DNS_A); if (!empty($domainhost)){ echo "</br>"; }
                    single_type_dns_get_record($domainhost, DNS_CNAME); if (!empty($domainhost)){ echo "</br>"; }
                    single_type_dns_get_record($domainhost, DNS_MX); if (!empty($domainhost)){ echo "</br>"; }
                    single_type_dns_get_record($domainhost, DNS_NS); if (!empty($domainhost)){ echo "</br>"; }
                    single_type_dns_get_record($domainhost, DNS_TXT); if (!empty($domainhost)){ echo "</br>"; }
                        function single_type_dns_get_record($dns, $type){
                            $res=dns_get_record($dns, $type); 
                            foreach($res as $ar){ 
                                foreach($ar as $key=>$val){
                                    echo $key.":".$val." ";
                                }
                            echo "</br>"; 
                        }
                    }
                ?>
            </form>
            </div>
        </div>
    </section>

    <footer class="footer nohighlight">
        <p class="pull-right">
        <a href="https://sys-ops.id">sys-ops.id</a>
        </p>
        <p>Powered by <a href="https://sys-ops.id">sys-ops.id</a></p>
    </footer>
</div>

<!--<script src="assets/js/jquery-1.11.2.min.js"></script>  -->
    <script src="assets/js/LookingGlass.min.js"></script>
<!--<script src="assets/js/XMLHttpRequest.min.js"></script>  -->
</body>
</html>

