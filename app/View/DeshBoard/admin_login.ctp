 
<body>	
<section id="inner-headline">
<div class="container">
	<h2 class="pageTitle text-center">Welcome <?php echo $this->Session->read('User.name');?></h2>
	</div
	</section>
<div class="container">
<?php if (!empty($HelpRecords)) { ?>
<strong><h4>Give Help Requests</h4></strong> 
<div class="panel panel-default">
  <div class="panel-heading col-xs-12">
   <h5 class="col-xs-2">Select</h5>
    <h5 class="text-center col-xs-2">Amount</h5>
    <h5 class="text-center col-xs-2">Comitment Date</h5>
    <h5 class="text-center col-xs-2">Name</h5>
    <h5 class="text-center col-xs-2">Email</h5>
    <h5 class="text-center col-xs-2">Asign To</h5>
   </div>
  <div class="panel-body">
      <?php foreach ($HelpRecords['giveHelp'] as $key => $value) { ?>
          <div class="col-xs-2  "><input type="checkbox" name=""></div>
          <div class="col-xs-2  text-center"><label class="control-label"><?php echo $value['GiveHelp']['amount'];?></label></div>
          <div class="col-xs-2  text-center"><label class="control-label"><?php echo $value['GiveHelp']['start_time'];?></label></div>
          <div class="col-xs-2  text-center"><label class="control-label"><?php echo $value['User']['name'];?></label></div>
          <div class="col-xs-2  text-center"><label class="control-label"><?php echo $value['User']['email'];?></label></div>
          <div class="col-xs-2  text-center"><Select class="control-label"><?php foreach ($HelpRecords['getHelp'] as $key => $value2) {
            if($value['User']['email'] != $value2['User']['email']) {
            echo '<option>'.$value2['User']['name'].' | '.$value2['User']['email'].'</option>'; } } ?></Select></div>
          <div class="clearfix"></div>
  </div>
  <?php } }?>
  <?php if (!empty($leads)) { ?>
  <strong><h4>Visitors list</h4></strong> 
  <div class="row">
    <table class="table table-responsive">
      <tr class="text-center"><td>Select</td>
      <td>Name</td>
      <td>Email</td>
      <td>Mobile</td>
      <td>Date</td>
      <td>Source</td>
      <td>Comments</td>
      </tr>
     <?php foreach ($leads as $key => $value) { ?>
        <div class="clearfix"></div>
        <tr class="text-center"><td>Select</td>
            <td><?php echo $value['PopLead']['name'];?></td>
            <td><?php echo $value['PopLead']['email'];?></td>
            <td><?php echo $value['PopLead']['mobile'];?></td>
            <td><?php echo $value['PopLead']['created'];?></td>
            <td><?php echo $value['PopLead']['source'];?></td>
            <td><?php echo $value['PopLead']['comments'];?></td>
        </tr>
    <?php } }?>
  </div>
  
       
</div>

        
<!-- javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

</body>

<style type="text/css">
.m-b-3{
    margin-bottom: 3%;
  }
  #inner-headline {
    background: #e7e7e7 ;
    border-bottom: 1px solid #cbcbcb;
    color: #358a22;
    height: 80px;
    margin: 0 0 25px;
    padding: 12px 0;
    position: relative;
}
</style>