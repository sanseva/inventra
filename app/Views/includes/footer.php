<?php $this->session = \Config\Services::session(); ?>
<script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="SmoXkI-GqmxetXOCnRD6Z";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col fs-13 text-muted text-center" style="text-align: left !important;">
               Copyright &copy; <?=date('Y')?> Inventory . All rights  reserved
            </div>
             <div class="col fs-13 text-muted text-center" style="text-align: right !important;">
              <b>Version</b> <?=$this->session->get('c_var');?>
            </div>
        </div>
    </div>
</footer>