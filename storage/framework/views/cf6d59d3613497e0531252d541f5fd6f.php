<?php
    $fonts = '';
    $cssFont = '';
    foreach (glob(LOKASI_FONT_DESA . '*.ttf') as $font) {
        $url = site_url($font);
        $nameFont = ucfirst(pathinfo($font, PATHINFO_FILENAME));
    
        $fonts .= $nameFont . '=' . pathinfo($font, PATHINFO_FILENAME) . '; ';
        $cssFont .= "
            @font-face {
                font-family: '{$nameFont}';
                src: url($url) format('truetype');
            }
        ";
    }
    $fonts = trim($fonts);
    $cssFont = trim($cssFont);
?>

<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript" src="<?php echo e(asset('js/tinymce-651/tinymce.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/tinymce.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            var default_font = "<?php echo e(setting('font_surat')); ?>"
            var fonts = " <?php echo e($fonts); ?>";

            var pratinjau = window.location.href.includes("pratinjau");
            if (!pratinjau) {
                plugins_tambahan = ['advlist', 'autolink', 'lists', 'charmap', 'hr', 'pagebreak', 'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'insertdatetime', 'nonbreaking', 'table', 'contextmenu', 'directionality', 'emoticons', 'paste', 'textcolor', 'code',
                    'responsivefilemanager', 'salintemplate', 'kodeisian'
                ];
            } else {
                plugins_tambahan = ['advlist', 'autolink', 'lists', 'charmap', 'hr', 'pagebreak', 'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'insertdatetime', 'nonbreaking', 'table', 'contextmenu', 'directionality', 'emoticons', 'paste', 'textcolor', 'code'];
            }
            var pageBreakCss = pratinjau ? `` : `
            .mce-pagebreak {   
                        border:none; 
                        cursor: default;
                        display: block;
                        height: 25px;
                        margin-top: 64px;
                        margin-bottom: 64px;
                        page-break-before: always;
                        width: 120%;
                        margin-left: -9.6%;
                        background-color: #ECEEF4
                    }`
            tinymce.init({
                selector: '.editor',
                promotion: false,
                formats: {
                    menjorok: {
                        block: 'p',
                        styles: {
                            'text-indent': '30px'
                        }
                    },
                    aligntop: {
                        title: 'Align Top',
                        selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,td,img,audio,video',
                        classes: 'aligntop'
                    },
                    alignmiddle: {
                        title: 'Align Middle',
                        selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,td,img,audio,video',
                        classes: 'alignmiddle'
                    },
                    alignbottom: {
                        title: 'Align Bottom',
                        selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,td,img,audio,video',
                        classes: 'alignbottom'
                    }
                },
                style_formats: [{
                        title: 'Align Top',
                        format: 'aligntop'
                    },
                    {
                        title: 'Align Middle',
                        format: 'alignmiddle'
                    },
                    {
                        title: 'Align Bottom',
                        format: 'alignbottom'
                    }
                ],
                block_formats: 'Paragraph=p; Header 1=h1; Header 2=h2; Header 3=h3; Header 4=h4; Header 5=h5; Header 6=h6; Div=div; Preformatted=pre; Blockquote=blockquote; Menjorok=menjorok',
                style_formats_merge: true,
                table_sizing_mode: 'relative',
                height: "<?php echo e($height ?? 700); ?>",
                // theme: 'silver',
                plugins: plugins_tambahan,
                content_style: `body { font-family: ${default_font}; }`,
                toolbar1: "removeformat | bold italic underline subscript superscript | bullist numlist outdent indent lineheight | alignleft aligncenter alignright alignjustify | blocks fontfamily fontsizeinput",
                // toolbar2: "responsivefilemanager | salintemplate | kodeisian " + (!pratinjau ? " | insertpagebreak | kotakrapat | kotak" : ""),
                toolbar2: "responsivefilemanager | salintemplate | kodeisian " + (!pratinjau ? " | insertpagebreak" : ""),
                // toolbar: [{ name: 'blocks', items: [ 'p', 'h', 'menjorok' ] },],
                image_advtab: true,
                external_plugins: {
                    "filemanager": "<?php echo e(asset('kelola_file/plugin.min.js')); ?>"
                },
                // content_css: [
                //     '//fonts.googleapis.com/css2?family=Noto+Sans+Javanese:wght@400..700&display=swap',
                //     '//www.tinymce.com/css/codepen.min.css'
                // ],
                skin: 'tinymce-5',
                relative_urls: false,
                remove_script_host: false,
                entity_encoding: 'raw',
                font_size_input_default_units: 'pt',
                line_height_formats: '1 1.15 1.5 2 2.5 3',
                // gak bisa pakai false
                //forced_root_block: false, 
                forced_root_block: ' ',
                font_family_formats: `Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black; Bookman Old Style=bookman old style; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Tahoma=tahoma,arial,helvetica,sans-serif; Times New Roman=times new roman,times; Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva;${fonts}`,
                setup: function(ed) {
                    ed.ui.registry.addButton('insertpagebreak', {
                        text: 'Tambah Halaman Baru',
                        onAction: function() {
                            // Insert a page break when the button is clicked
                            ed.insertContent('<div style="page-break-after: always;"><!-- pagebreak --></div><p></p>');
                            ed.execCommand('removeFormat')
                        }
                    });
                    // ed.ui.registry.addButton('kotak', {
                    //     text: 'Kotak',
                    //     onAction: function(_) {
                    //         var selectedText = ed.selection.getContent({
                    //             format: 'text'
                    //         })
                    //         var replacedText = `[#[${selectedText.replace(/^\[*/,'').replace(/\]*$/,'')}]#]`
                    //         ed.selection.setContent(replacedText)
                    //     }
                    // });
                    // ed.ui.registry.addButton('kotakrapat', {
                    //     text: 'Kotak Rapat',
                    //     onAction: function(_) {
                    //         var selectedText = ed.selection.getContent({
                    //             format: 'text'
                    //         })
                    //         var replacedText = `[##[${selectedText.replace(/^\[*/,'').replace(/\]*$/,'')}]##]`
                    //         ed.selection.setContent(replacedText)
                    //     }
                    // });
                    ed.on('init', function(e) {
                        ed.execCommand("fontName", false, "${default_font}");
                        ed.execCommand("fontSize", false, "14pt");
                    });

                    ed.options.register('fontsize_formats', {
                        processor: 'string',
                        default: '8pt 10pt 12pt 14pt 18pt 24pt 36pt'
                    });
                    // pakai button saja
                    // if (!pratinjau) {
                    //     ed.on('keydown', function() {
                    //         var contentAreaHeight = ed.getBody().offsetHeight;
                    //         var lengthPaper = 1644;
                    //         var sisaBatasKertas = contentAreaHeight % lengthPaper
                    //         console.log('sisaBatasKertas ' + sisaBatasKertas)
                    //         // Check if a new line has been added
                    //         if (sisaBatasKertas > 0 && sisaBatasKertas < 35) {
                    //             ed.insertContent('<div style="page-break-after: always;"><!-- pagebreak --></div>');
                    //         }
                    //     });
                    // }
                },
                content_style: `
                    body {
                        background: #fff;
                    }
                    @media (min-width: 840px) {
                        html {
                            background: #eceef4;
                            min-height: 100%;
                            padding: 0 .5rem;
                        }
                        body {
                            background-color: #fff;
                            box-shadow: 0 0 4px rgba(0, 0, 0, .15);
                            box-sizing: border-box;
                            margin: 1rem auto 0;
                            max-width: 820px;
                            min-height: calc(100vh - 1rem);
                            padding:4rem;
                        }
                    }
                    .aligntop {
                        vertical-align: top;
                    }
                    .alignmiddle {
                        vertical-align: middle;
                    }
                    .alignbottom {
                        vertical-align: bottom;
                    }
                    <?php echo $cssFont; ?>

                    
                    ${pageBreakCss}
                `
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\resources\views/admin/pengaturan_surat/asset_tinymce.blade.php ENDPATH**/ ?>