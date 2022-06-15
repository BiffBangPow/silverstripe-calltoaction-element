<div class="container my-5">
    <% if $Title && $ShowTitle %>
        <div class="row">
            <div class="col-12">
                <h2>$Title</h2>
            </div>
        </div>
    <% end_if %>
    <div class="cta-grid">
        <% loop $CTAs %>
            <div class="cta-holder $Up.ColumnClass">
                <a class="cta-link"
                   href="<% if $CTAType == 'Download' %>$DownloadFile.URL<% else %>$Action.Link<% end_if %>"
                   <% if $CTAType == 'Download' %>download<% end_if %>>
                    <div class="cta-image"
                         style="background-image: url('<% if $Up.WebPSupport %>$Image.ScaleWidth(500).Format('webp').URL<% else %>$Image.ScaleWidth(500).URL<% end_if %>')">
                        <div class="shader"></div>
                        <div class="cta-content">
                            <h3>$Title</h3>
                            <p>$Content</p>
                        </div>
                        <img class="readmore icon-white" src=""
                             data-src="$ThemeDir/client/dist/img/icons/arrow-right.svg" alt="Right arrow"
                             loading="lazy">
                        <div class="cover"></div>
                    </div>
                </a>
            </div>
        <% end_loop %>
    </div>
</div>
