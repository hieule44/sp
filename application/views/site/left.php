      <div class="box-left" class="">
         <div class="title tittle-box-left w3-theme-d3">
			  <h2> Tìm kiếm theo giá </h2>
		</div>
		<div class="content-box" ><!-- The content-box -->
	           <form class="t-form form_action" method="post" style='padding:10px' action="product/search_price.html" name="search" >

                  <div class="form-row">
						<label for="param_price_from" class="form-label" style='width:60px'>Giá từ:<span class="req">*</span></label>
						<div class="form-item"  style='width:90px'>
							<select  class="input" id="price_from" name="price_from" >
							    <option value="0">0 đ</option>
							</select>
							<div class="clear"></div>
							<div class="error" id="price_from_error"></div>
						</div>
						<div class="clear"></div>
				  </div>
				  <div class="form-row">
						<label for="param_price_from" class="form-label" style='width:60px'>Giá tới:<span class="req">*</span></label>
						<div class="form-item"  style='width:90px'>
							<select  class="input" id="price_to" name="price_to" >
							  <option value="1000000" >0 đ</option>
							     							</select>
							<div class="clear"></div>
							<div class="error" id="price_from_error"></div>
						</div>
						<div class="clear"></div>
				  </div>

				  <div class="form-row">
						<label class="form-label">&nbsp;</label>
						<div class="form-item">
				           	<input type="submit" class="button"  name='search' value="Tìm kiềm" style='height:30px !important;line-height:30px !important;padding:0px 10px !important'>
						</div>
						<div class="clear"></div>
				   </div>
            </form>
	    </div><!-- End content-box -->
</div>


<div class="box-left">
         <div class="title tittle-box-left">
			  <h2> Danh mục sản phẩm </h2>
		</div>
		<div class="content-box"><!-- The content-box -->
	        <ul class="catalog-main">
	        <?php foreach($catalog_list as $row): ?>
                <li><span><a href="<?php echo product_url('catalog/'.$row->id.'/'.urlencode($row->name)) ?>" title="<?php echo $row->name ?>"><?php echo $row->name ?></a></span>
                     <!-- lay danh sach danh muc con -->
                     <?php if(!empty($row->con)): ?>
             	 	<ul class="catalog-sub">
             	 		<?php foreach($row->con as $con):  ?>
             	 	    <li>
                            <a href="<?php echo product_url('catalog/'.$con->id.'/'.urlencode($con->name)) ?>" title=" <?php echo $con->name ?>"><?php echo $con->name ?></a>
                        </li>
                    	<?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                </li>
	        <?php endforeach; ?>
            </ul>

	    </div><!-- End content-box -->
</div>
