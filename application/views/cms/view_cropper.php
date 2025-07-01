<?php if ($this->session->flashdata('pesanerror')) { ?>
    <script language="javascript" type="text/javascript">
        window.onload = function(){
            swal({
                title: "Failed!",
                text: "<?php echo $this->session->flashdata('pesanerror');?>",
                type: "error",
                confirmButtonText: "Close"
            });
        }
    </script>
<?php } ?>
<?php if ($this->session->flashdata('pesansukses')) { ?>
    <script language="javascript" type="text/javascript">
        window.onload = function(){
            swal({
                title: "Success",
                text: "<?php echo $this->session->flashdata('pesansukses');?>",
                type: "success",
                confirmButtonText: "Close"
            });
        }
    </script>
<?php } ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js" integrity="sha512-9KkIqdfN7ipEW6B6k+Aq20PV31bjODg4AA52W+tYtAE0jE0kMx49bjJ3FgvS56wzmyfMUHbQ4Km2b7l9+Y/+Eg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.css" integrity="sha512-bs9fAcCAeaDfA4A+NiShWR886eClUcBtqhipoY5DM60Y1V3BbVQlabthUBal5bq8Z8nnxxiyb1wfGX2n76N1Mw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="right_col container cropper">
    <div class="row" >
        <div class="col-md-9">
            <div class="img-container">
                <img id="image" src="" alt="Picture" class="cropper-hidden"></div>
        </div>
    </div>
    <div class="col-md-3" style="float: right; margin-top: -39%;">
        <div class="docs-preview clearfix">
            <div class="img-preview preview-lg" style="width: 263px; height: 147.938px;"></div>
            <div class="img-preview preview-md" style="width: 138.667px; height: 78px;"></div>
            <div class="img-preview preview-sm" style="width: 69px; height: 38.8125px;"></div>
            <div class="img-preview preview-xs" style="width: 35px; height: 19.6875px;"></div>
        </div>
        <div class="docs-data">
            <div class="input-group input-group-sm">
                <label class="input-group-addon" for="dataX">X</label>
                <input type="text" class="form-control" id="dataX" placeholder="x">
                <span class="input-group-addon">px</span>
            </div>
            <div class="input-group input-group-sm">
                <label class="input-group-addon" for="dataY">Y</label>
                <input type="text" class="form-control" id="dataY" placeholder="y">
                <span class="input-group-addon">px</span>
            </div>
            <div class="input-group input-group-sm">
                <label class="input-group-addon" for="dataWidth">Width</label>
                <input type="text" class="form-control" id="dataWidth" placeholder="width">
                <span class="input-group-addon">px</span>
            </div>
            <div class="input-group input-group-sm">
                <label class="input-group-addon" for="dataHeight">Height</label>
                <input type="text" class="form-control" id="dataHeight" placeholder="height">
                <span class="input-group-addon">px</span>
            </div>
            <div class="input-group input-group-sm">
                <label class="input-group-addon" for="dataRotate">Rotate</label>
                <input type="text" class="form-control" id="dataRotate" placeholder="rotate">
                <span class="input-group-addon">deg</span>
            </div>
            <div class="input-group input-group-sm">
                <label class="input-group-addon" for="dataScaleX">ScaleX</label>
                <input type="text" class="form-control" id="dataScaleX" placeholder="scaleX">
            </div>
            <div class="input-group input-group-sm">
                <label class="input-group-addon" for="dataScaleY">ScaleY</label>
                <input type="text" class="form-control" id="dataScaleY" placeholder="scaleY">
            </div>
        </div>
    </div>

    <div class="row" id="actions">
        <div class="col-md-9 docs-buttons">

            <div class="btn-group">
                <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="move" title="Move">
                    <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;setDragMode&quot;, &quot;move&quot;)">
                        <span class="fa fa-arrows"></span>
                    </span>
                </button>
                <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="crop" title="Crop">
                    <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;setDragMode&quot;, &quot;crop&quot;)">
                        <span class="fa fa-crop"></span>
                    </span>
                </button>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In">
                    <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;zoom&quot;, 0.1)">
                        <span class="fa fa-search-plus"></span>
                    </span>
                </button>
                <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out">
                    <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;zoom&quot;, -0.1)">
                        <span class="fa fa-search-minus"></span>
                    </span>
                </button>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-primary" data-method="move" data-option="-10" data-second-option="0" title="Move Left">
                    <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;move&quot;, -10, 0)">
                        <span class="fa fa-arrow-left"></span>
                    </span>
                </button>
                <button type="button" class="btn btn-primary" data-method="move" data-option="10" data-second-option="0" title="Move Right">
                    <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;move&quot;, 10, 0)">
                        <span class="fa fa-arrow-right"></span>
                    </span>
                </button>
                <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="-10" title="Move Up">
                    <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;move&quot;, 0, -10)">
                        <span class="fa fa-arrow-up"></span>
                    </span>
                </button>
                <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="10" title="Move Down">
                    <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;move&quot;, 0, 10)">
                        <span class="fa fa-arrow-down"></span>
                    </span>
                </button>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45" title="Rotate Left">
                    <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;rotate&quot;, -45)">
                        <span class="fa fa-rotate-left"></span>
                    </span>
                </button>
                <button type="button" class="btn btn-primary" data-method="rotate" data-option="45" title="Rotate Right">
                    <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;rotate&quot;, 45)">
                        <span class="fa fa-rotate-right"></span>
                    </span>
                </button>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-primary" data-method="scaleX" data-option="-1" title="Flip Horizontal">
                    <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;scaleX&quot;, -1)">
                        <span class="fa fa-arrows-h"></span>
                    </span>
                </button>
                <button type="button" class="btn btn-primary" data-method="scaleY" data-option="-1" title="Flip Vertical">
                    <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;scaleY&quot;, -1)">
                        <span class="fa fa-arrows-v"></span>
                    </span>
                </button>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-primary" data-method="crop" title="Crop">
                    <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;crop&quot;)">
                        <span class="fa fa-check"></span>
                    </span>
                </button>
                <button type="button" class="btn btn-primary" data-method="clear" title="Clear">
                    <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;clear&quot;)">
                        <span class="fa fa-remove"></span>
                    </span>
                </button>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-primary" data-method="disable" title="Disable">
                    <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;disable&quot;)">
                        <span class="fa fa-lock"></span>
                    </span>
                </button>
                <button type="button" class="btn btn-primary" data-method="enable" title="Enable">
                    <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;enable&quot;)">
                        <span class="fa fa-unlock"></span>
                    </span>
                </button>
            </div>
            <div class="btn-group">

                <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                    <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">
                    <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Import image with Blob URLs">
                        Import
                        <span class="fa fa-upload"></span>
                    </span>
                </label>
                <button type="button" class="btn btn-primary" data-method="getCroppedCanvas">
                    <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;getCroppedCanvas&quot;)">
                        Download
                    </span>
                </button>
            </div>

            <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="getCroppedCanvasTitle">Cropped</h4>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <a class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.png">Download</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 docs-toggles">

            <div class="btn-group btn-group-justified" data-toggle="buttons">
                <label class="btn btn-primary active">
                    <input type="radio" class="sr-only" id="aspectRatio0" name="aspectRatio" value="1.7777777777777777">
                    <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="aspectRatio: 16 / 9">
                    16:9
                    </span>
                </label>
                <label class="btn btn-primary">
                    <input type="radio" class="sr-only" id="aspectRatio1" name="aspectRatio" value="1.3333333333333333">
                    <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="aspectRatio: 4 / 3">
                    4:3
                    </span>
                </label>
                <label class="btn btn-primary">
                    <input type="radio" class="sr-only" id="aspectRatio2" name="aspectRatio" value="1">
                    <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="aspectRatio: 1 / 1">
                    1:1
                    </span>
                </label>
                <label class="btn btn-primary">
                    <input type="radio" class="sr-only" id="aspectRatio3" name="aspectRatio" value="0.6666666666666666">
                    <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="aspectRatio: 2 / 3">
                    2:3
                    </span>
                </label>
                <label class="btn btn-primary">
                    <input type="radio" class="sr-only" id="aspectRatio4" name="aspectRatio" value="NaN">
                    <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="aspectRatio: NaN">
                    Free
                    </span>
                </label>
            </div>
        </div>
    </div>
</div>
<script>
    // import 'cropperjs/dist/cropper.css';
    window.onload = function () {
        'use strict';

        var Cropper = window.Cropper;
        var URL = window.URL || window.webkitURL;
        console.log(URL + " lalala ")
        if (URL) {
            console.log("truee")
        }
        var container = document.querySelector('.img-container');
        var image = container.getElementsByTagName('img').item(0);
        var download = document.getElementById('download');
        var actions = document.getElementById('actions');
        var dataX = document.getElementById('dataX');
        var dataY = document.getElementById('dataY');
        var dataHeight = document.getElementById('dataHeight');
        var dataWidth = document.getElementById('dataWidth');
        var dataRotate = document.getElementById('dataRotate');
        var dataScaleX = document.getElementById('dataScaleX');
        var dataScaleY = document.getElementById('dataScaleY');
        var options = {
            aspectRatio: 16 / 9,
            preview: '.img-preview',
            ready: function (e) {
                console.log(e.type);
            },
            cropstart: function (e) {
                console.log(e.type, e.detail.action);
            },
            cropmove: function (e) {
                console.log(e.type, e.detail.action);
            },
            cropend: function (e) {
                console.log(e.type, e.detail.action);
            },
            crop: function (e) {
                var data = e.detail;

                console.log(e.type);
                dataX.value = Math.round(data.x);
                dataY.value = Math.round(data.y);
                dataHeight.value = Math.round(data.height);
                dataWidth.value = Math.round(data.width);
                dataRotate.value = typeof data.rotate !== 'undefined' ? data.rotate : '';
                dataScaleX.value = typeof data.scaleX !== 'undefined' ? data.scaleX : '';
                dataScaleY.value = typeof data.scaleY !== 'undefined' ? data.scaleY : '';
            },
            zoom: function (e) {
                console.log(e.type, e.detail.ratio);
            }
        };
        var cropper = new Cropper(image, options);
        var originalImageURL = image.src;
        var uploadedImageType = 'image/jpeg';
        var uploadedImageName = 'cropped.jpg';
        var uploadedImageURL;

        // Tooltip
        $('[data-toggle="tooltip"]').tooltip();

        // Buttons
        if (!document.createElement('canvas').getContext) {
            $('button[data-method="getCroppedCanvas"]').prop('disabled', true);
        }

        if (typeof document.createElement('cropper').style.transition === 'undefined') {
            $('button[data-method="rotate"]').prop('disabled', true);
            $('button[data-method="scale"]').prop('disabled', true);
        }

        // Download
        if (typeof download.download === 'undefined') {
            download.className += ' disabled';
            download.title = 'Your browser does not support download';
        }

        // Options
        actions.querySelector('.docs-toggles').onchange = function (event) {
            var e = event || window.event;
            var target = e.target || e.srcElement;
            var cropBoxData;
            var canvasData;
            var isCheckbox;
            var isRadio;

            if (!cropper) {
                return;
            }

            if (target.tagName.toLowerCase() === 'label') {
                target = target.querySelector('input');
            }

            isCheckbox = target.type === 'checkbox';
            isRadio = target.type === 'radio';

            if (isCheckbox || isRadio) {
                if (isCheckbox) {
                    options[target.name] = target.checked;
                    cropBoxData = cropper.getCropBoxData();
                    canvasData = cropper.getCanvasData();

                    options.ready = function () {
                        console.log('ready');
                        cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
                    };
                } else {
                    options[target.name] = target.value;
                    options.ready = function () {
                        console.log('ready');
                    };
                }

                // Restart
                cropper.destroy();
                cropper = new Cropper(image, options);
            }
        };

        // Methods
        actions.querySelector('.docs-buttons').onclick = function (event) {
            var e = event || window.event;
            var target = e.target || e.srcElement;
            var cropped;
            var result;
            var input;
            var data;

            if (!cropper) {
                return;
            }

            while (target !== this) {
                if (target.getAttribute('data-method')) {
                    break;
                }

                target = target.parentNode;
            }

            if (target === this || target.disabled || target.className.indexOf('disabled') > -1) {
                return;
            }

            data = {
                method: target.getAttribute('data-method'),
                target: target.getAttribute('data-target'),
                option: target.getAttribute('data-option') || undefined,
                secondOption: target.getAttribute('data-second-option') || undefined
            };

            cropped = cropper.cropped;

            if (data.method) {
                if (typeof data.target !== 'undefined') {
                    input = document.querySelector(data.target);

                    if (!target.hasAttribute('data-option') && data.target && input) {
                        try {
                            data.option = JSON.parse(input.value);
                        } catch (e) {
                            console.log(e.message);
                        }
                    }
                }

                switch (data.method) {
                    case 'rotate':
                        if (cropped && options.viewMode > 0) {
                            cropper.clear();
                        }

                        break;

                    case 'getCroppedCanvas':
                        try {
                            data.option = JSON.parse(data.option);
                        } catch (e) {
                            console.log(e.message);
                        }

                        if (uploadedImageType === 'image/jpeg') {
                            if (!data.option) {
                                data.option = {};
                            }

                            data.option.fillColor = '#fff';
                        }

                        break;
                }

                result = cropper[data.method](data.option, data.secondOption);

                switch (data.method) {
                    case 'rotate':
                        if (cropped && options.viewMode > 0) {
                            cropper.crop();
                        }

                        break;

                    case 'scaleX':
                    case 'scaleY':
                        target.setAttribute('data-option', -data.option);
                        break;

                    case 'getCroppedCanvas':
                        if (result) {
                            // Bootstrap's Modal
                            $('#getCroppedCanvasModal').modal().find('.modal-body').html(result);

                            if (!download.disabled) {
                                download.download = uploadedImageName;
                                download.href = result.toDataURL(uploadedImageType);
                            }
                        }

                        break;

                    case 'destroy':
                        cropper = null;

                        if (uploadedImageURL) {
                            URL.revokeObjectURL(uploadedImageURL);
                            uploadedImageURL = '';
                            image.src = originalImageURL;
                        }

                        break;
                }

                if (typeof result === 'object' && result !== cropper && input) {
                    try {
                        input.value = JSON.stringify(result);
                    } catch (e) {
                        console.log(e.message);
                    }
                }
            }
        };

        document.body.onkeydown = function (event) {
            var e = event || window.event;

            if (e.target !== this || !cropper || this.scrollTop > 300) {
                return;
            }

            switch (e.keyCode) {
                case 37:
                    e.preventDefault();
                    cropper.move(-1, 0);
                    break;

                case 38:
                    e.preventDefault();
                    cropper.move(0, -1);
                    break;

                case 39:
                    e.preventDefault();
                    cropper.move(1, 0);
                    break;

                case 40:
                    e.preventDefault();
                    cropper.move(0, 1);
                    break;
            }
        };

        // Import image
        var inputImage = document.getElementById('inputImage');

        if (URL) {
            inputImage.onchange = function () {
                var files = this.files;
                var file;

                if (files && files.length) {
                    file = files[0];

                    if (/^image\/\w+/.test(file.type)) {
                        uploadedImageType = file.type;
                        uploadedImageName = file.name;

                        if (uploadedImageURL) {
                            URL.revokeObjectURL(uploadedImageURL);
                        }

                        image.src = uploadedImageURL = URL.createObjectURL(file);

                        if (cropper) {
                            cropper.destroy();
                        }

                        cropper = new Cropper(image, options);
                        inputImage.value = null;
                    } else {
                        window.alert('Please choose an image file.');
                    }
                }
            };
        } else {
            inputImage.disabled = true;
            inputImage.parentNode.className += ' disabled';
        }
    };
</script>
<!-- /page content -->