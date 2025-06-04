 <!-- Header-->
 <header class="bg-dark py-5" id="main-header">
    <div class="container h-100 d-flex align-items-center justify-content-center w-100">
        <div class="text-center text-white w-100">
            <!-- <h1 class="display-4 fw-bolder mx-5"><?php //echo $_settings->info('name') ?></h1> -->
			<div class="logo-animation">
    <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 900 200"
        class="kupido-logo"
    >
        <text
            x="50"
            y="150"
            font-size="60"
            fill="white"
            stroke="white"
            stroke-width="2"
            font-family="Arial, sans-serif"
        >
            <?php echo $_settings->info('name'); ?>
        </text>
    </svg>
</div>

<style>
    .kupido-logo text {
        stroke-dasharray: 1600;
        stroke-dashoffset: 1600;
        animation: draw 6s ease-in-out forwards;
    }

    @keyframes draw {
        to {
            stroke-dashoffset: 0;
        }
    }
</style>

            <div class="col-auto mt-4">
                <!-- <a class="btn btn-warning btn-lg rounded-0" href="./?p=booking">Book Now</a> -->
            </div>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <div class="container">
        <div class="card shadow card-outline card-purple rounded-0">
            <div class="card-body">
                <?php include './welcome.html' ?>
            </div>
        </div>
    </div>
</section>
<script>
    $(function(){
        $('#search').on('input',function(){
            var _search = $(this).val().toLowerCase().trim()
            $('#service_list .item').each(function(){
                var _text = $(this).text().toLowerCase().trim()
                    _text = _text.replace(/\s+/g,' ')
                    console.log(_text)
                if((_text).includes(_search) == true){
                    $(this).toggle(true)
                }else{
                    $(this).toggle(false)
                }
            })
            if( $('#service_list .item:visible').length > 0){
                $('#noResult').hide('slow')
            }else{
                $('#noResult').show('slow')
            }
        })
        $('#service_list .item').hover(function(){
            $(this).find('.callout').addClass('shadow')
        })
        $('#service_list .view_service').click(function(){
            uni_modal("Service Details","view_service.php?id="+$(this).attr('data-id'),'mid-large')
        })
        $('#send_request').click(function(){
            uni_modal("Fill the Service Request Form","send_request.php",'large')
        })

    })
    $(document).scroll(function() { 
        $('#topNavBar').removeClass('bg-purple navbar-light navbar-dark bg-gradient-purple text-light')
        if($(window).scrollTop() === 0) {
           $('#topNavBar').addClass('navbar-dark bg-purple text-light')
        }else{
           $('#topNavBar').addClass('navbar-dark bg-gradient-purple ')
        }
    });
    $(function(){
        $(document).trigger('scroll')
    })
</script>