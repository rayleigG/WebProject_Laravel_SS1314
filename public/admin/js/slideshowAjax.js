function deleteSlideshow(id) {
    var deleteBut = document.getElementById("deleteBut");
    var url = "{{ route('admin.deleteSlideshow', ['id' => ':id']) }}";
    deleteBut.href = url.replace(':id', id);
}
//SELECT 
const getData = () => {
    const xhr = new XMLHttpRequest();
    xhr.responseType = 'json';
    xhr.open('GET', 'getslideshow', true);

    xhr.onload = () => {
        if (xhr.status === 200) {
            const response = xhr.response;
            console.log(response);
            const data = response.slideshows.data;
            const res = response.slideshows;
            // Populate table rows
            let tr = '';
            for (let i = 0; i < data.length; i++) {
                const currentIndex = (parseInt(res.current_page) - 1) * parseInt(res.per_page) + parseInt(i) + 1;
                const ssid = data[i].ssid;
                tr += `
                    <tr>
                        <td>${currentIndex}</td>
                        <td>...</td>
                        <td>${data[i].title.substr(0, 10) + '...'}</td>
                        <td>${data[i].subtitle + '...'}</td>
                        <td>${data[i].text.substr(0, 15) + '...'}</td>
                        <td>
                            <a href="${data[i].toggleSlideshowURL}">
                            <i class="#"></i>
                            </a>
                            &nbsp;
                            <a href="{{ route('reorderSlideshow', ['id' => ${ssid}, 'action' => '1']) }}">
                            <i class="fas fa-level-up-alt"></i>
                            </a>
                            &nbsp;
                            <a href="#">
                            <i class="fas fa-level-down-alt"></i>
                            </a>
                            &nbsp;
                            <a href="#">
                            <i class="far fa-edit"></i>
                            </a>
                            &nbsp;
                            <a href="#" onclick="deleteSlideshow('${data[i].ssid}')">
                            <i class="fas fa-trash-alt" data-bs-toggle="modal" data-bs-target="#deleteModal"></i>
                            </a>
                        </td>
                    </tr>
                    `; 
            }
            document.getElementById('tableBody').innerHTML = tr;

            // Handle pagination links
            const paginationContainer = document.getElementById('paginationContainer');
            const paginationLinks = response.slideshows.links;
            console.log(paginationLinks);
            // Generate pagination links
            let paginationHTML = '';
            for (let i = 0; i < paginationLinks.length; i++) {
                const link = paginationLinks[i];
                if (link.active) {
                    paginationHTML +=
                        `<li class="page-item active"><span class="page-link">${link.label}</span></li>`;
                } else if (link.url) {
                    paginationHTML +=
                        `<li class="page-item"><a href="${link.url}" class="page-link">${link.label}</a></li>`;
                } else {
                    paginationHTML +=
                        `<li class="page-item disabled"><span class="page-link">${link.label}</span></li>`;
                }
            }
            console.log(paginationHTML);
            paginationContainer.innerHTML = `<ul class="pagination">${paginationHTML}</ul>`;
            // Attach event listeners to pagination links
            const paginationLinksArray = paginationContainer.getElementsByTagName('a');
            for (let i = 0; i < paginationLinksArray.length; i++) {
                paginationLinksArray[i].addEventListener('click', function (event) {
                    event.preventDefault();
                    const pageUrl = this.getAttribute('href');
                    fetchPageData(pageUrl);
                });
            }
        }
    };

    xhr.send();
}

// Function to fetch data for a specific page
function fetchPageData(pageUrl) {
    const xhr = new XMLHttpRequest();
    xhr.responseType = 'json';
    xhr.open('GET', pageUrl, true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            const response = xhr.response;
            const data = response.slideshows.data;
            const res = response.slideshows;

            // Populate table rows
            let tr = '';
            for (let i = 0; i < data.length; i++) {
                const currentIndex = (parseInt(res.current_page) - 1) * parseInt(res.per_page) + parseInt(i) +
                    1;
                console.log(currentIndex);
                const substring = data[i].title.substr(0, 5) + "...";
                tr += `
                    <tr>
                        <td>${currentIndex}</td>
                        <td>...</td>
                        <td>${data[i].title.substr(0, 10) + '...'}</td>
                        <td>${data[i].subtitle + '...'}</td>
                        <td>${data[i].text.substr(0, 15) + '...'}</td>
                        <td>
                            <a href="${data[i].toggleSlideshowURL}">
                                <i class="#"></i>
                            </a>
                            &nbsp;
                            <a href="#">
                                <i class="fas fa-level-up-alt"></i>
                            </a>
                            &nbsp;
                            <a href="#">
                                <i class="fas fa-level-down-alt"></i>
                            </a>
                            &nbsp;
                            <a href="#">
                                <i class="far fa-edit"></i>
                            </a>
                            &nbsp;
                            <a href="#" onclick="deleteSlideshow('${data[i].ssid}')">
                                <i class="fas fa-trash-alt" data-bs-toggle="modal" data-bs-target="#deleteModal"></i>
                            </a>
                            </td>
                  </tr>
                `;
            }
            document.getElementById('tableBody').innerHTML = tr;

            // Update pagination links
            const paginationContainer = document.getElementById('paginationContainer');
            const paginationLinks = response.slideshows.links;
            // Generate pagination links
            let paginationHTML = '';
            for (let i = 0; i < paginationLinks.length; i++) {
                const link = paginationLinks[i];
                if (link.active) {
                    paginationHTML +=
                        `<li class="page-item active"><span class="page-link">${link.label}</span></li>`;
                } else if (link.url) {
                    paginationHTML +=
                        `<li class="page-item"><a href="${link.url}" class="page-link">${link.label}</a></li>`;
                } else {
                    paginationHTML +=
                        `<li class="page-item disabled"><span class="page-link">${link.label}</span></li>`;
                }
            }
            paginationContainer.innerHTML = `<ul class="pagination">${paginationHTML}</ul>`;
            // Attach event listeners to pagination links
            const paginationLinksArray = paginationContainer.getElementsByTagName('a');
            for (let i = 0; i < paginationLinksArray.length; i++) {
                paginationLinksArray[i].addEventListener('click', function (event) {
                    event.preventDefault();
                    const pageUrl = this.getAttribute('href');
                    fetchPageData(pageUrl);
                });
            }
        }
    };

    xhr.send();
}
getData();

function reorderSlideshow(id, action) {
    const data = {
      id: id,
      action: action
    };
  
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '{{ route("reorderSlideshow") }}', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
  
    xhr.onload = function () {
      if (xhr.status === 200) {
        console.log(xhr.responseText);
        getData();
      } else {
        console.error('Error:', xhr.status);
      }
    };  
    xhr.send(JSON.stringify(data));
  }
  