<div class="card">
    <div class="card-header bg-info">
        <h4 class="mb-0 text-white">Identifikačné údaje zmluvy</h4>
    </div>
    <div class="card-body">
        <div class="form-body">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label class="control-label">Číslo zákazky</label>
                        <input type="text" class="form-control" name="Data[contract_number]" value="<?= $contract['number'] ?>">
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="control-label">Účel</label>
                        <select class="form-control select-drop" name="Data[purpose][]" multiple="multiple" id="ucel">
                            <?php
                            foreach($contract_type as $type) {

                                echo "<option value={$type['id']}>{$type['name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Maklér</label>
                        <select class="form-control select-drop" name="Data[agent][id]" id="main-agent" onchange="getComission()">
                            <option value="">-- Zvoľte makléra --</option>
                            <?php
                            foreach($agents as $item) {
                                $selected = $agent['agent_id'] == $item['id'] ? ' selected' : '';
                                echo "<option value={$item['id']} data-content={$item['comission']}{$selected}>{$item['name_first']} {$item['name_last']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="control-label">Provízia makléra(%)</label>
                        <input
                            type="text"
                            class="form-control"
                            name="Data[agent][comission]"
                            id="main-comission"
                            value="<?= $agent['comission']?>"
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>