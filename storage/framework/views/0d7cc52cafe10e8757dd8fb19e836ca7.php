<div class="input-group my-colorpicker2">
    <input
        type="text"
        class="form-control input-sm"
        id="input<?php echo e($value['key']); ?>"
        name="opsi[<?php echo e($value['key']); ?>]"
        placeholder="<?php echo e($value['placeholder']); ?>"
        value="<?php echo e($value['default']); ?>"
        <?php echo e($value['readonly']); ?>

        <?php echo $value['attributes']; ?>

    />
    <div class="input-group-addon input-sm"></div>
</div>
<?php /**PATH C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\resources\views/admin/theme/components/form/color-picker.blade.php ENDPATH**/ ?>