<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OX</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Butcherman&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">

    <style>
        button{
            transition: color 100ms ease;
        }

        button.blink{
            color:transparent;
        }

        .items {
            font-size: 5rem;
            font-family: 'Butcherman', cursive;
            color: #343a40;
            cursor: pointer;
        }

        .game-header {
            font-size: 4rem;
            font-family: 'Butcherman', cursive;
            color: #fff;
        }

        .winner {
            font-size: 3rem;
            color: #5A7FE3;
        }        

        .footer {
            position:fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #343a40;
            color: white;
            text-align: center;
        }


    </style>

    <script>
        var prev = '';
        var endgame = false;

        window.setInterval(function(){
            $('#select').toggleClass('blink');
        }, 600);
        
        function startGame() {
            $('#row_start').hide();
            $('#row_item_1').show();
            $('#row_item_2').show();
            $('#row_item_3').show();
            $('#row_play').show();
            firstPlayer();
            
        }

        function firstPlayer() {
            let random_player = Math.floor(Math.random() * 10);
            if (random_player % 2 == 0 ) {
                $('#player').val("Player O");
            } else {
                $('#player').val("Player X");
            }
        }

        function restartGame() {
            endgame = false;
            $('#row_play').show();
            $('#row_restart').hide();
            $('.items').text("TT");
            $('.items').css('color','#343a40');
            firstPlayer();
            
            
        }

        $(document).ready(function() {
            

            $(".items").click(function(event) {
                if (endgame == true) {
                    return;
                }

                if ($(this).css('color') == 'rgb(255, 255, 0)') {
                    return;
                }
                var item = $('#player').val().substring(7);
                if (prev != '' ) {
                    $('#'+prev).html("TT");
                    $('#'+prev).css('color','#343a40');
                }
                $('#'+ $(this).attr("id")).css('color','#C0C0C0');
                $('#'+ $(this).attr("id")).html(item);
                prev = $(this).attr("id");
            });

            $(".items").dblclick(function(event) {
                if (endgame == true) {
                    return;
                }
                
                if ($(this).css('color') == 'rgb(255, 255, 0)') {
                    return;
                }
                $('#item_id').val($(this).attr("id"));
                $('#okModal').modal();
            });
        });


        function okGame() {
            if($('#item_id').val() == '' ) {
                return;
            }
            
            prev = '';
            $('#' + $('#item_id').val()).css('color','yellow');
            checkResult();
            $('#item_id').val("")
            if ($('#player').val() == "Player O") {
                $('#player').val("Player X");
            } else {
                $('#player').val("Player O");
            }
        }

        function checkResult() {
            if ($('#ans_A1').text().trim() == $('#ans_A2').text().trim() && $('#ans_A2').text().trim() == $('#ans_A3').text().trim()) {
                showWiner($('#ans_A1').attr("id"));
            } else if ($('#ans_B1').text().trim() == $('#ans_B2').text().trim() && $('#ans_B2').text().trim() == $('#ans_B3').text().trim()) {
                showWiner($('#ans_B1').attr("id"));
            } else if ($('#ans_C1').text().trim() == $('#ans_C2').text().trim() && $('#ans_C2').text().trim() == $('#ans_C3').text().trim()) {
                showWiner($('#ans_C1').attr("id"));
            } else if ($('#ans_A1').text().trim() == $('#ans_B1').text().trim() && $('#ans_B1').text().trim() == $('#ans_C1').text().trim()) {
                showWiner($('#ans_A1').attr("id"));
            } else if ($('#ans_A2').text().trim() == $('#ans_B2').text().trim() && $('#ans_B2').text().trim() == $('#ans_C2').text().trim()) {
                showWiner($('#ans_A2').attr("id"));
            } else if ($('#ans_A3').text().trim() == $('#ans_B3').text().trim() && $('#ans_B3').text().trim() == $('#ans_C3').text().trim()) {
                showWiner($('#ans_A3').attr("id"));
            } else if ($('#ans_A1').text().trim() == $('#ans_B2').text().trim() && $('#ans_B2').text().trim() == $('#ans_C3').text().trim()) {
                showWiner($('#ans_A1').attr("id"));
            } else if ($('#ans_A3').text().trim() == $('#ans_B2').text().trim() && $('#ans_B2').text().trim() == $('#ans_C1').text().trim()) {
                showWiner($('#ans_A3').attr("id"));
            } else {
                if ($('#ans_A1').text().trim().length == 1 && $('#ans_A2').text().trim().length == 1 && $('#ans_A3').text().trim().length == 1 &&
                    $('#ans_B1').text().trim().length == 1 && $('#ans_B2').text().trim().length == 1 && $('#ans_B3').text().trim().length == 1 &&
                    $('#ans_C1').text().trim().length == 1 && $('#ans_C2').text().trim().length == 1 && $('#ans_C3').text().trim().length == 1 ) {
                        $('#row_play').hide();
                        $('#row_restart').show();
                        $('.winner').html("DRAW");
                        $('#winnerModal').modal();
                        endgame  = true;
                }
            }
        }

        function showWiner(id) {
            if ($('#' + id).text().trim().length == 2) {
                return;
            }
            $('#row_play').hide();
            $('#row_restart').show();
            $('.winner').html($('#player').val());
            $('#winnerModal').modal();
            endgame  = true;
        }
    </script>
</head>
<body class="bg-dark">
    <div class="container-fluid h-100"  >
        <div class="row justify-content-center game-header">
            OX&nbsp; &nbsp;GAME &nbsp; &nbsp; V.2.0.0
        </div>
        <div class="container-fluid  h-100">
        <div class="row justify-content-center h-25 " id="row_item_1" style="display:none; height: 300px;">
            <div class="col-lg-2 pt-0 pl-0" style ="border-right: 5px solid #9EE0E2; border-bottom: 5px solid #9EE0E2;" >
                <center id="ans_A1" class="items">
                    TT
                </center>
            </div>

            <div class="col-lg-2  pt-0 pl-0" style ="border-right: 5px solid #9EE0E2; border-left: 5px solid #9EE0E2; border-bottom: 5px solid #9EE0E2;"  >
                <center id="ans_A2" class="items" >
                    TT
                </center>
            </div>
            
            <div class="col-lg-2  pt-0 pl-0" style ="border-left: 5px solid #9EE0E2; border-bottom: 5px solid #9EE0E2;"  >
                <center id="ans_A3" class="items">
                    TT
                </center>
            </div>
        </div>
        <div class="row justify-content-center h-25 " id="row_item_2" style="display:none;">
            <div class="col-lg-2 pt-0 pl-0" style ="border-right: 5px solid #9EE0E2; border-top: 5px solid #9EE0E2; border-bottom: 5px solid #9EE0E2;"  >
                <center id="ans_B1" class="items">
                    TT
                </center>
            </div>

            <div class="col-lg-2  pt-0 pl-0" style ="border: 5px solid #9EE0E2;"  >
                <center id="ans_B2" class="items">
                    TT
                </center>
            </div>
            
            <div class="col-lg-2  pt-0 pl-0" style ="border-left: 5px solid #9EE0E2; border-top: 5px solid #9EE0E2; border-bottom: 5px solid #9EE0E2;"  >
                <center id="ans_B3" class="items">
                    TT
                </center>
            </div>
        </div>
        <div class="row justify-content-center h-25" id="row_item_3" style="display:none;">
            <div class="col-lg-2 pt-0 pl-0" style ="border-right: 5px solid #9EE0E2; border-top: 5px solid #9EE0E2;"  >
                <center id="ans_C1" class="items">
                    TT
                </center>
            </div>

            <div class="col-lg-2  pt-0 pl-0" style ="border-right: 5px solid #9EE0E2; border-left: 5px solid #9EE0E2; border-top: 5px solid #9EE0E2;"  >
                <center id="ans_C2" class="items">
                    TT
                </center>
            </div>
            
            <div class="col-lg-2  pt-0 pl-0" style ="border-left: 5px solid #9EE0E2; border-top: 5px solid #9EE0E2;"  >
                <center id="ans_C3" class="items">
                    TT
                </center>
            </div>
        </div>
        </div>
        <div class="row h-100  justify-content-center align-content-center" id="row_start" >
            <button id="select" class="btn btn-info btn-lg btn-block shadow" onclick="startGame();" style="border-radius: 0px; position:fixed; top:45%;"  >
                <h1 style="font-family: 'Oswald', sans-serif;">
                    START!
                </h1>
            </button>
        </div>

        <div class="row justify-content-center mt-3" id="row_play" style="display: none;">
            <div class="col-lg-4  pt-0 pl-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="font-family: 'Oswald', sans-serif;">PLAYER NAME</span>
                    </div>
                    <input type="text" class="form-control form-control-lg"  value="" id="player" readonly style="font-family: 'Oswald', sans-serif; color: blue;">
                </div>
                <div class="row justify-content-center mb-0 mt-2">
                    <b style="color: orange;">click</b>
                    &nbsp;&nbsp;
                    <p style="color: white;">for SELECT A BOX</p>
                    &nbsp;&nbsp;
                    <p style ="color: #C0C0C0;">/</p>
                    &nbsp;&nbsp;
                    <b style="color: green;">doubleclick</b>
                    &nbsp;&nbsp;
                    <p style="color: white;">for CONFIRM TO SELECT A BOX</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-3" id="row_restart" style="display: none;">
            <div class="col-lg-2">
                <button type="button" class="btn btn-info btn-block shadow" onclick="restartGame();">
                    <i class="fas fa-undo fa-1x" style="color: #fff;" ></i>
                    <h5 class="">Try Again</h5>
                </button>
            </div>
        </div>


    </div>

    <div class="footer">
        <p class="text-white">Copyright &copy; Supakin Sakunwa</p>
    </div>


    <!-- The Modal -->
    <div class="modal fade" id="winnerModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
      
                <!-- Modal Header -->
                <div class="modal-header justify-content-center">
                    <h4 class="modal-title">RESULT</h4>
                </div>
        
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <p  class="winner" >
                        </p>
                    </div>
                </div>
        
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                </div>
        
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="okModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
      
                <!-- Modal Header -->
                <div class="modal-header justify-content-center">
                    <h4 class="modal-title">CONFIRM</h4>
                </div>
        
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <h5>
                            PLEASE CLICK YES FOR SELECT A BOX
                        </h5>
                    </div>
                    <input type="hidden" id="item_id" val="">
                </div>
        
                <!-- Modal footer -->
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary" onclick="okGame();" data-dismiss="modal">YES</button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">NO</button>
                </div>
        
            </div>
        </div>
    </div>
</body>
</html>