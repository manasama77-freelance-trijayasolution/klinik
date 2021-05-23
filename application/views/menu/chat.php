<script type='text/javascript'>

(function()
{
  if( window.localStorage )
  {
    if( !localStorage.getItem( 'firstLoad' ) )
    {
      localStorage[ 'firstLoad' ] = true;
      window.location.reload();
    }  
    else
      localStorage.removeItem( 'firstLoad' );
  }
})();

</script>
<iframe scrolling="no" style="height: 420px; position: relative; top: -10px; width: 557px; margin-top: -89px; margin-left: -88px; " src="<?php echo base_url();?>home"></iframe>