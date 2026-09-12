<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<script>
    
jQuery("document").ready(function($) {

    // ==================================================
    // Dealing with uploading images
    // ==================================================

    $('.yydev_upload_image, .yydev_light_img_bg').click(function(e) {
        
        var uploadButtonParent = $(this).parent();

        e.preventDefault();
        var image = wp.media({
        title: 'Upload Image'}).open()
        .on('select', function(e){

            // This will return the selected image from the Media Uploader, the result is an object
            var images_length = image.state().get("selection").length;
            var images = image.state().get("selection").models;

            console.log(images);

            var image_url = images[0].toJSON().url;
            var image_alt = images[0].toJSON().alt;
            var image_caption = images[0].toJSON().caption;
            var image_title = images[0].toJSON().title;
            var image_id = images[0].toJSON().id;

            // Let's assign the url value to the input field
            uploadButtonParent.find('.yydev_light_img_bg').attr('src', image_url); // changing image icon
            uploadButtonParent.find('.yydev_image_input').val(image_url); // changing input url

        }); // .on('select', function(e){

    }); // $('.edit-button-image-upload').click(function(e) {

    // ==================================================
    // Changing the background of icon image on background change
    // ==================================================

    $('input#background_color').change(function() {
        
        var backgroundValue = $(this).val();
        $("img.yydev_light_img_bg").css("background", backgroundValue);

    }); // $('input#background_color').change(function() {

    // ===========================================  
    // SVG Upload and Controls  
    // ===========================================

    // SVG uploader functionality
    $('.yydev_upload_svg, .yydev_light_svg_bg').click(function(e) {
        
        var uploadButtonParent = $(this).parent();

        e.preventDefault();
        var svg = wp.media({
        title: 'Upload SVG'}).open()
        .on('select', function(e){

            // This will return the selected SVG from the Media Uploader, the result is an object
            var svgs_length = svg.state().get("selection").length;
            var svgs = svg.state().get("selection").models;

            console.log(svgs);

            var svg_url = svgs[0].toJSON().url;
            var svg_alt = svgs[0].toJSON().alt;
            var svg_caption = svgs[0].toJSON().caption;
            var svg_title = svgs[0].toJSON().title;
            var svg_id = svgs[0].toJSON().id;

            // Let's assign the url value to the input field
            uploadButtonParent.find('.yydev_light_svg_bg').attr('src', svg_url); // changing SVG icon
            uploadButtonParent.find('.yydev_svg_input').val(svg_url); // changing input url
            updateSVGPreviewSize(); // Update size after new SVG is loaded

        }); // .on('select', function(e){

    }); // $('.yydev_upload_svg').click(function(e) {

    // Dynamic icon type control
    $('#icon_type').change(function() {
        var iconType = $(this).val();
        
        if (iconType === 'svg') {
            $('#icon_size_section').show();
            $('#svg_url_section').show();
            $('#image_url_section').hide();
        } else {
            $('#icon_size_section').hide();
            $('#svg_url_section').hide();
            $('#image_url_section').show();
        }
    });

    // Trigger change event on page load to set initial state
    $('#icon_type').trigger('change');

    // SVG background color update
    $('input#background_color').change(function() {
        
        var backgroundValue = $(this).val();
        $("img.yydev_light_img_bg").css("background", backgroundValue);
        $("img.yydev_light_svg_bg").css("background", backgroundValue);

    }); // $('input#background_color').change(function() {

    // SVG Size Preview Updates
    $('#icon_width, #icon_height, #button_width, #button_height').on('input keyup change', function() {
        if ($('#icon_type').val() === 'svg') {
            updateSVGPreviewSize();
        }
    });

    // Function to update SVG preview size
    function updateSVGPreviewSize() {
        var iconWidth = $('#icon_width').val();
        var iconHeight = $('#icon_height').val();
        var buttonWidth = $('#button_width').val() || '45';
        var buttonHeight = $('#button_height').val() || '45';
        var previewSvg = $('.yydev_light_svg_bg');
        
        // Use SVG dimensions if provided, otherwise use button dimensions
        var finalWidth = (iconWidth && iconWidth !== '') ? iconWidth : buttonWidth;
        var finalHeight = (iconHeight && iconHeight !== '') ? iconHeight : buttonHeight;
        
        // Apply size to SVG preview
        if (previewSvg.length > 0) {
            previewSvg.css({
                'width': finalWidth + 'px',
                'height': finalHeight + 'px'
            });
        }
    }

    // Initialize SVG preview size on page load
    setTimeout(function() {
        if ($('#icon_type').val() === 'svg') {
            updateSVGPreviewSize();
        }
    }, 300);

}); // jQuery("document").ready(function($) {

</script>