<div class="gopy_box deal_out">
    <div class="gopy_all_b">
        <div class="gopy_title">
            <span class="top_pop_left">
                <img style="position:relative;top:17px;float:left;margin-left:5px;" src="<?php echo $template_path; ?>/top_bul.png" alt="NhomMua"/>
            </span>
            <span style="float:left;margin-left:10px;text-transform:uppercase;">KHÔNG BỎ LỠ SẢN PHẨM NÀY</span>
            <span class="btnGopyclose">
                <img title="<?php echo $tenngan; ?> - Tắt của sổ này" src="<?php echo $template_path; ?>/new_close_btn.png" alt="Đóng" />
            </span>
        </div>
		<div class="clear"></div>
		<div class="proBody_body">            <div class="Promo_dt_bg">                
		<div class="Promo_dt_div">    
		<div class="Promo_dt_cont">   
			<div class="col_left"> 
			<div class="img_bg">
			<img width="300" height="185" alt="<?php echo $team['product']; ?>" src="<?php echo team_image($team['image1']); ?>"/>                            
			</div>
			</div>
		<div class="col_right">
		<p class="icon_st"><i></i><i></i><i></i><i></i><i></i>                            </p>
		<p class="link name"><?php echo $team['product']; ?></p> 
		<p class="txt_ip"><?php echo $team['title']; ?></p> 
		</div>
		<p class="txt_ip notice"><?php echo $INI['system']['sitename']; ?> sẽ thông báo cho bạn khi deal này chạy lại hoặc lên deal tương tự</p> 
		</div>            
		</div>        
		</div>       
		</div>
        <div class="gopy_content">
		<div class="gopy_notice"></div>
            <form id="frmgopy" method="post" action="#">
			<input type="hidden" value="<?php echo $team['id']; ?>" name="teamid"/>
                <div class="gopy_item">
                    <span class="gopy_ileft">Họ tên:<span class="gopy_require">*</span></span>
                    <span class="gopy_iright">
                        <input id="tbxGopyFullName" name="tbxGopyFullName" class="gopy_input" style="margin:4px;" type="text"/>
                    </span>
                </div>

                <div class="gopy_item">
                    <span class="gopy_ileft">Email:<span class="gopy_require">*</span></span>
                    <span class="gopy_iright">
                        <input id="tbxGopyEmail" name="tbxGopyEmail" class="gopy_input" style="margin:4px;" type="text"/>
                    </span>
                </div>

                <div class="gopy_item">
                    <span class="gopy_ileft">Điện thoại:<span class="gopy_require">*</span></span>
                    <span class="gopy_iright">
                        <input id="tbxGopyPhone" name="tbxGopyPhone" class="gopy_input" style="margin:4px;width:120px;" maxlength="12" onkeypress="blockNotPhoneNumber(event)" type="text"/>
                    </span>
                </div>

                <div class="gopy_item" style="margin-top: 4px;margin-left: 4px;">
                    <span class="gopy_ileft">Địa chỉ:<span class="gopy_require">*</span></span>
                    <span class="gopy_iright">
                        <input id="tbxGopYContent" name="tbxGopYContent" class="gopy_area" maxlength="200" type="text"/>
                    </span>
                </div>
                <div class="gopy_item" style="line-height:40px;">
     
                        <span style="float:right;margin-top:8px;margin-right:35px; cursor:pointer" class="btn_gopy">
						<b id="btnGopY" class="btn_send" style="margin:0"></b>
						</span>
                    </span>
                </div>
                

            </form>
        </div>
    </div>
</div>