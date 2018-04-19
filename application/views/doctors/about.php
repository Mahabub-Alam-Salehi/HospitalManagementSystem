<?php
?>
<div class="clearfix"></div>
<div class="x_panel">
  <div class="x_title">
    <h2><?php echo $doctor[0]->name; ?></h2>
    <ul class="nav navbar-right panel_toolbox">
      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
      </li>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <div class="row">
      <div class="col-xs-12 col-md-6">
        <table class="table">
          <?php
            $printArray  = array(
                  'name' => 'Doctor Name',
                  'nic' => 'National Id Number',
                  'department' => 'Department',
                  'blood_group' => 'Glood Group',
                  'birth_date' => 'Birth Day',
                  'sex' => 'Gender',
                  'email' => 'Email Address',
                  'phone' => 'Phone Number',
                  'country' => 'Country',
                  'state' => 'City/State',
                  'address' => 'Address',
              );
            foreach ($printArray as $key => $value) {
              ?>
              <tr>
                <td><?php echo $value; ?></td>
                <td><?php echo $doctor[0]->$key; ?></td>
              </tr>
              <?php
            }
          ?>
        </table>
      </div>
      <div class="col-xs-12 col-md-6">
        <div class="about_text">
          <?php echo $doctor[0]->about; ?>
        </div>
      </div>
    </div>
    
  </div>
</div>

