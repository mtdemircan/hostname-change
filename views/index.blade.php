<ul class="nav nav-tabs" role="tablist" style="margin-bottom: 15px;">
    <li class="nav-item">
        <a class="nav-link active"  onclick="tab1()" href="#tab1" data-toggle="tab">Status</a>
    </li>
    <li class="nav-item">
        <a class="nav-link "  onclick="tab2()" href="#tab2" data-toggle="tab">/etc/hosts</a>
    </li>
    <li class="nav-item">
        <a class="nav-link "  onclick="tab3()" href="#tab3" data-toggle="tab">Current Hostname</a>
    </li>
    <li class="nav-item">
        <a class="nav-link "  onclick="tab4()" href="#tab4" data-toggle="tab">Change Hostname</a>
    </li>
</ul>

<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane active" id="tab1" role="tabpanel" value="test" >
        <div class="table-responsive" id="hostname"></div>
    </div>
    <pre class="tab-pane fade" id="tab2" role="tabpanel"></pre>
    <div class="tab-pane fade" id="tab3" role="tabpanel">
        <button class="btn btn-success mb-2" id="tab3button" onclick="hostNameButtonClicked()" type="button">hostname</button>
        <div class="table-responsive" id="hostname"></div>
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
    </div>
    <div class="tab-pane fade" id="tab4" role="tabpanel">
        <button class="btn btn-success mb-2" id="tab4button" onclick="neww()" type="button">hostname change</button>
        <div class="table-responsive" id="hostname"></div>
        <!-- <form action="/functions.php" method="post"> -->
            <label for="fname">New Hostname:</label>
            <input type="text" id="fname" name="fname"><br><br>
            <input type="submit" value="Submit" onclick="newHostnameEntered()">
        <!-- </form> -->
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form action="functions.php" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Metin Girisi</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <input type="text" id="modaltext" name="modaltext" placeholder="metin giriniz">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default" data-dismiss="modal" onclick="dialogClosed()">OK</button>
            </div>
        </div>
    </form>
  </div>
</div>

<!-- <div class="tab-content">
    <div id="tab1" class="tab-pane active">
    </div>

    <pre id="tab2" class="tab-pane">
    </pre>

    <div id="tab3" class="tab-pane active">
        <button class="btn btn-success mb-2" id="asd" onclick="tab3()" type="button">hostname</button>
        <div class="table-responsive" id="hostname"></div>
    </div>

    <div id="tab4" class="tab-pane active">
        <button class="btn btn-success mb-2" id="asd" onclick="tab4()" type="button">hostnamectl set-hostname</button>
        <div class="table-responsive" id="hostnamectl"></div>
    </div>
</div> -->

<script>

   if(location.hash === ""){
        tab1();
    }

    function dialogClosed() {
        var dialogMessage = document.getElementById('modaltext').value;
        showSwal(dialogMessage, 'success', 5000);
    }

    function tab1(){
        //console.log(document.getElementById('tab1').getAttribute('value'));
        var form = new FormData();
        request("{{API('tab1')}}", form, function(response) {
            message = JSON.parse(response)["message"];
            showSwal(message, 'success', 3000);
            var a=message.substring(0,message.indexOf(" "));
            message=message.substring(message.indexOf(" ")+1);
            var b=message.substring(0,message.indexOf(" "));
            message=message.substring(message.indexOf(" ")+1);
            var c=message;
            $('#tab1').html("current hostname:"+a+"</br>settings hostname:"+b+"</br>current fqdn:"+c);
            if(a==b)
            showSwal("success", 'success', 5000);
            else
            showSwal("error", 'error', 5000);

        }, function(error) {
            $('#tab1').html("Hata oluştu");
        });
        
    }

    function tab2(){        
        var form = new FormData();
        request("{{API('tab2')}}", form, function(response) {
            message = JSON.parse(response)["message"];
            showSwal(message, 'success', 3000);
            $('#tab2').html(message);
        }, function(error) {
            $('#tab2').html("Hata oluştu");
        });
    }
    function hostNameButtonClicked() {
        var form = new FormData();
        request("{{API('tab3')}}", form, function(response) {
            message = JSON.parse(response)["message"];
            $('#tab3').html(message);
        }, function(error) {
            $('#tab3').html("Hata oluştu");
        });
    }
    function tab3(){        
        // var form = new FormData();
        // request("{{API('tab3')}}", form, function(response) {
        //     message = JSON.parse(response)["message"];
        //     $('#tab3').html(message);
        // }, function(error) {
        //     $('#tab3').html("Hata oluştu");
        // });
    }
    function tab4(){        
        // var form = new FormData();
        // request("{{API('tab3')}}", form, function(response) {
        //     message = JSON.parse(response)["message"];
        //     $('#tab3').html(message);
        // }, function(error) {
        //     $('#tab3').html("Hata oluştu");
        // });
    }

    function neww(){   
        var form = new FormData();
        request("{{API('tab4')}}", form, function(response) {
            message = JSON.parse(response)["message"];
            $('#tab4').html(message);
        }, function(error) {
            $('#tab4').html("Hata oluştu");
        });
    }
    function newHostnameEntered() {

        var newHost = document.getElementById('fname').value;
        var form = new FormData();
        form.id = "newHost";
        form.name = newHost;
        console.log(form);
        console.log(request);
        form.append("new", form.name);
        request("{{API('changeHost')}}", form, function(response) {
            message = JSON.parse(response)["message"];
            showSwal(message, 'success', 5000);
        }, function(error) {
            $('#tab4').html(error);
        });
    }
</script>