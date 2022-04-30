<template>
<div>
        <div id="WAButton"></div> <br>
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    © 2021 Adeptlessor<span class="d-none d-sm-inline-block"> - Crafted with <i class="mdi mdi-heart text-danger"></i> by Idrizzy and Repzlaw. </span>
                </div>
            </div>
        </div>
    </footer>
</div>
</template>

<script>
export default {

    mounted() {

        //  method to display whatsapp button on page and also connect to whatsapp API
        $(function () {
           $('#WAButton').floatingWhatsApp({
               phone: '+2349053811061', //WhatsApp Business phone number
               headerTitle: 'Chat with Adept Lessor Ltd!', //Popup Title
               popupMessage: 'Hello, how can I help you?', //Popup Message
               showPopup: true, //Enables popup display
               buttonImage: '<img src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/whatsapp.svg" />', //Button Image
               //headerColor: 'crimson', //Custom header color
               //backgroundColor: 'crimson', //Custom background button color
               position: "right" //Position: left | right

           });
        });
    },

}
</script>

<style>
.floating-wpp{
        bottom: 55px !important;
    }
</style>