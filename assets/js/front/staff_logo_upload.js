(function () {
	var logoUpload = document.getElementById("staff_logo"),
		fileList = document.getElementById("file-list");
	function uploadLogo (file) {
		var img,
			reader,
			xhr,
			fileInfo;
		
		/*
			If the file is an image and the web browser supports FileReader,
			present a preview in the file list
		*/
		if (typeof FileReader !== "undefined" && (/image/i).test(file.type)) {
			img = document.createElement("img");
			reader = new FileReader();
			reader.onload = (function (theImg) {
				return function (evt) {
					theImg.src = evt.target.result;
					$('#staff_logo_view').attr('src', evt.target.result);
				};
			}(img));
			reader.readAsDataURL(file);
		}
		
		// Uploading - for Firefox, Google Chrome and Safari
		xhr = new XMLHttpRequest();
		
		// Update progress bar
		xhr.upload.addEventListener("progress", function (evt) {
			if (evt.lengthComputable) {

				jQuery("#staff_logo_loader").erezervo("show");
			}
			else {
				// No data to calculate on
			}
		}, false);
		
		// File uploaded
		xhr.addEventListener("load", function () {
			jQuery("#staff_logo_loader").erezervo("hide").delay(1000).hide(0,'',function(){
				$("#staff_logo_loader").hide();
				$("#staff_logo_view").show();
				jQuery("#remove_photo").show();
			});
		}, false);
		
		xhr.open("post", "", true);
		
		// Set appropriate headers
		// xhr.setRequestHeader("Content-Type", "multipart/form-data");
		// xhr.setRequestHeader("X-File-Name", file.name);
		// xhr.setRequestHeader("X-File-Size", file.size);
		// xhr.setRequestHeader("X-File-Type", file.type);

		// Send the file (doh)
		xhr.send(file);
		
		// Present file info and append it to the list of files
		// fileInfo = "<div><strong>Name:</strong> " + file.name + "</div>";
		// fileInfo += "<div><strong>Size:</strong> " + parseInt(file.size / 1024, 10) + " kb</div>";
		// fileInfo += "<div><strong>Type:</strong> " + file.type + "</div>";
		
	}
	
	function traverseLogo (files) {

		if (typeof files !== "undefined") {
			for (var i=0, l=files.length; i<l; i++) {

					var blnValid = false;

		                var ext = files[0]['name'].substring(files[0]['name'].lastIndexOf('.') + 1);
						if(ext == "gif" || ext == "GIF" || ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "png" || ext == "PNG")
						{
		                    blnValid = true;
		                }
		                if (!blnValid) {
			                sweetAlert("Sorry, " + files[0]['name'] + " is invalid, allowed extensions are: gif , jpeg , jpg , png");
			                return false;
			            }
		           
				uploadLogo(files[i]);
			}
		}
		else {
			sweetAlert("No support for the File API in this web browser");
		}	
	}
	
	logoUpload.addEventListener("change", function () {
		traverseLogo(this.files);
	}, false);
								
})();