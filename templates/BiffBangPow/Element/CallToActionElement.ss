<div class="container my-5">
    <% if $Title && $ShowTitle %>
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="element-title">$Title</h2>
            </div>
        </div>
    <% end_if %>

    <div class="row">
        <% loop $CTAs %>
            <div class="cta-holder $ColumnClass mb-4 d-flex">
                <div class="cta-image h-100 p-3 p-lg-4" <% if $Image %>style="background-size: cover; background-position: center; background-image: url('<% if $Up.WebPSupport %>$Image.ScaleWidth(500).Format('webp').URL<% else %>$Image.ScaleWidth(500).URL<% end_if %>')"<% end_if %>>
                    <div class="shader"></div>
                    <% if $ShowTitle || $Content %>
                        <div class="cta-content">
                            <% if $ShowTitle %>
                                <p class="cta-title">$Title</p>
                            <% end_if %>
                            <% if $Content %>
                                <p class="mb-4">$Content</p>
                            <% end_if %>
                        </div>
                    <% end_if %>
                    <% if $CTAType != 'None' %>
                        <p class="cta-holder mt-4">
                            <a href="$CTALink" class="cta-link btn btn-outline-primary"
                                <% if $CTAType == 'External' %>target="_blank" rel="noopener"
                                <% else_if $CTAType == 'Download' %>download
                                <% end_if %>>
                                $LinkText
                            </a>
                        </p>
                    <% end_if %>
                </div>
            </div>
        <% end_loop %>
    </div>
</div>
