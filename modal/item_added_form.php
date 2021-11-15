<!-- Modal -->
<div class="modal fade" id="item_added_form" role="dialog">
    <form id="item_added_form_value">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header modal_header_custom_background">
                    <h4 class="modal-title">Material add</h4>
                </div>
                <div class="modal-body modal_body_custom_background">
                    <div class="modal_body_centerize">                    
                        <div class="form-group">
                            <label class="control-label col-sm-5" for="parent_code">Parent Category:</label>
                            <div class="col-sm-7">
                                <select class="form-control" id="main_item_id" name="parent_item_id" onchange="getSubCategoryByParent(this.value);">
                                    <option value="">Select</option>
                                    <?php
                                    $parentCats = getTableDataByTableName('inv_materialcategorysub', '', 'category_description');
                                    if (isset($parentCats) && !empty($parentCats)) {
                                        foreach ($parentCats as $pcat) {
                                            ?>
                                            <option value="<?php echo $pcat['id'] ?>"><?php echo $pcat['category_description'] ?></option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-5" for="parent_code">Sub Category:</label>
                            <div class="col-sm-7">
                                <select class="form-control" id="main_sub_item_id" name="sub_item_id" onchange="getMatCodeBySubId(this.value);">
                                    <option value="">Select</option>
                                    <?php
                                    $parentCats = getTableDataByTableName('inv_materialcategory','','material_sub_description');
                                    if (isset($parentCats) && !empty($parentCats)) {
                                        foreach ($parentCats as $pcat) {
                                            ?>
                                            <option value="<?php echo $pcat['id'] ?>"><?php echo $pcat['material_sub_description'] ?></option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-5" for="parent_code">Material Code:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="item_code" placeholder="Enter item code" name="item_code">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-5" for="name">Name:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="item_name" placeholder="name" name="name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-5" for="name">Brand Name:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="brand_name" placeholder="brand name" name="brand_name">
                            </div>
                        </div>
						<div class="form-group">
                            <label class="control-label col-sm-5" for="parent_code">Type:</label>
                            <div class="col-sm-7">
                                <select class="form-control" id="type" name="type">
                                    <option value="">Select</option>
                                    <option value="CIVIL">CIVIL</option>
									<option value="ELECTRICAL">ELECTRICAL</option>
									<option value="MACHANICAL">MACHANICAL</option>
									<option value="SANITARY">SANITARY</option>
									<option value="HARDWARE">HARDWARE</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-5" for="parent_code">Unit:</label>
                            <div class="col-sm-7">
                                <select class="form-control" id="qty_unit" name="qty_unit" required>
                                    <option value="">Select</option>
                                    <?php
                                    $parentCats = getTableDataByTableName('inv_item_unit', '', 'unit_name');
                                    if (isset($parentCats) && !empty($parentCats)) {
                                        foreach ($parentCats as $pcat) {
                                            ?>
                                            <option value="<?php echo $pcat['id'] ?>"><?php echo $pcat['unit_name'] ?></option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-5" for="name">Material min stock:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="material_min_stock" placeholder="Material min stock" name="material_min_stock" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal_footer_custom_background">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-default" onclick="processItems('item_added_form_value')">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>