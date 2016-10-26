<script type="text/javascript" src="<?php echo ABSOLUTE_URL;?>/js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo ABSOLUTE_URL;?>/js/bootstrapValidator.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo ABSOLUTE_URL;?>/css/fortune.css">
<style type="text/css">

.icon-bar{background-color: #000000!important;}
.font-14{font-size: 14px; font-weight: bold; color:#ffffff !important;}
.font-22{font-size: 22px; font-weight: bold; color:#ffffff !important;}
.navbar-fixed-top{background-color: #5e001b !important;}
</style>
<div class="templatemo-top-bar" id="templatemo-top"  >
        <div id="flashMessage" class="message text-center">
            <?php echo $this->Session->flash(); ?>
        </div>*/?>
<div class="navbar  navbar-default navbar-fixed-top transparent-nav" role="navigation" id="siteNavigation">
    <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
             <a href="" class="navbar-brand font-22">Fortune Power</a>
    </div>
            <div class="container">
                <div class="subheader">
                    <div class="navbar-collapse col-xs-12 row pull-right collapse subheader" id="templatemo-nav-bar" style="margin-top:-5px;">
                            
                            <?php if(!$this->Session->read('User')){?> 
                             <ul class="nav navbar-nav navbar-right" >
                                <li class="active"><a class="font-14" href="<?php echo ABSOLUTE_URL;?>/home_pages/">HOME</a></li>
                                <li><a class="font-14" href="<?php echo ABSOLUTE_URL;?>/about">ABOUT</a></li>
                                <li><a class="font-14" href="<?php echo ABSOLUTE_URL;?>/plan">PLAN</a></li>
                                <li><a class="font-14" rel="nofollow" 
                                        class="external-link" data-toggle="modal" data-target="#login">LOGIN</a></li>
                                        <li><a class="font-14" rel="nofollow" 
                                        class="external-link" id="register" data-toggle="modal" data-target="#signUpForm">REGISTER</a></li>
                                <li><a class="font-14" href="<?php echo ABSOLUTE_URL;?>/home_pages/contactUs/">CONTACT</a></li></ul>
                                <?php } else {  if($this->action == 'help') {?>
                                  <ul class="nav navbar-nav navbar-right" style=" margin-right: 32px !important;">
                                  <?php } else { ?>
                                    <ul class="nav navbar-nav navbar-right" style=" ">
                                    <?php } ?>
                                    <li class=""><a class="font-14" href="<?php echo ABSOLUTE_URL;?>/home_pages/deshBoard">Home</a></li>
                                      <li class=""><a class="font-14" href="<?php echo ABSOLUTE_URL;?>/desh_board/getTree">View Team</a></li>
                                      <li><a class="font-14" href="<?php echo ABSOLUTE_URL;?>/plan">View Plan</a></li>
                                       <li class="dropdown ">
                                        <a class="font-14" href="#" class="dropdown-toggle font-14" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Total Income<span class="caret"></span></a>
                                         <ul class="dropdown-menu">
                                        <li><a   href="<?php echo ABSOLUTE_URL;?>/desh_board/income/active">Active-Zone Income</a>
                                        <li><a  href="<?php echo ABSOLUTE_URL;?>/desh_board/income/working">Working-Zone Income</a></li> 
                                        <li><a  href="<?php echo ABSOLUTE_URL;?>/desh_board/income/safe">Safe-Zone Income</a></li>
                                        <li><a  href="<?php echo ABSOLUTE_URL;?>/desh_board/income/royality">Royality</a></li>
                                        <li><a  href="<?php echo ABSOLUTE_URL;?>/desh_board/income/all">View all</a></li>
                                        </ul>
                                        </li>
                                      <li class=""><a class="font-14" href="<?php echo ABSOLUTE_URL;?>/home_pages/logout/">Logout</a></li>
                                      <li class=""><a class="font-14" id="bank" data-toggle="modal" data-target="#bankForm" >Bank Details</a></li></ul>
                                       <li><a class="font-14" href="<?php echo ABSOLUTE_URL;?>/about">ABOUT</a></li>

                               <?php } ?>
                    </div>
                    
                </div>
            </div>
            </div>
        </div>
</div>
</div>
        
  <div id="login"  class="modal fade" role="dialog">
      <div class="modal-content modal-dialog">
          <div class="modal-header">
              <button id="close" type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Login to site.com</h4>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-xs-6">
                      <div class="well">
                          <form id="loginForm" method="POST" action="<?php echo ABSOLUTE_URL;?>/home_pages/logins/" data-toggle="validator" >
                              <div class="form-group control-group">
                                  <label for="email" class="control-label" >Username</label>
                                  <input type="text" class="form-control" id="email" name="email" title="Please enter you username" placeholder="example@gmail.com" required="">
                                  <span class="help-block"></span>
                              </div>
                              <div class="form-group control-group">
                                  <label for="password" class="control-label">Password</label>
                                  <input type="password" class="form-control" id="password" name="password" value="" required="" title="Please enter your password">
                                  <span class="help-block"></span>
                              </div>
                              <div id="loginErrorMsg" class="alert alert-error hide">Wrong username og password</div>
                              <div class="checkbox">
                                  <label>
                                      <input type="checkbox" name="remember" id="remember"> Remember login
                                  </label>
                                  <p class="help-block">(if this is a private computer)</p>
                              </div>
                              <button type="submit" class="btn btn-success btn-block">Login</button>
                              <a href="/forgot/" class="btn btn-default btn-block">Help to login</a>
                          </form>
                      </div>
                  </div>
                  <div class="col-xs-6">
                      <p class="lead">Register now for <span class="text-success">FREE</span></p>
                      <ul class="list-unstyled" style="line-height: 2">
                          <li><span class="fa fa-check text-success"></span> See all your orders</li>
                          <li><span class="fa fa-check text-success"></span> Fast re-order</li>
                          <li><span class="fa fa-check text-success"></span> Save your favorites</li>
                          <li><span class="fa fa-check text-success"></span> Fast checkout</li>
                          <li><span class="fa fa-check text-success"></span> Get a gift <small>(only new customers)</small></li>
                          <li><a href="/read-more/"><u>Read more</u></a></li>
                      </ul>
                      <p><a id="reg" href="" class="btn btn-info btn-block">Yes please, register now!</a></p>
                  </div>
              </div>
          </div>
      </div>
  </div>
  
  <input type="hidden" id="tempLoginVar" value="0" /> 
 
<script type="text/javascript">
   $('ul.nav li.dropdown').hover(function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(50).fadeIn(150);
      }, function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(50).fadeOut(150);
      });
        $("#alreadyReg").click(function(){
            $("#signUpForm .close").click();
            $("#loginli").click();
        });
</script>