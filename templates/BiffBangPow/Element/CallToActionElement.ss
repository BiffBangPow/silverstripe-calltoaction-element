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
            <div class="cta-holder $ColumnClass mb-4 d-flex flex-column">
                <div class="cta-image h-100 mb-3">
                    <% with $Image.Fill(650, 360) %>
                        <img alt="$Title" class="img-fluid lazyload" src="$Convert('avif').URL" loading="lazy" width="$Width"
                             height="$Height">
                    <% end_with %>
                </div>
                <div>
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
                    <% with $CTA %>
                        <% if $exists %>
                            <div class="cta text-center">
                                <p>
                                    <a class="cta-link btn btn-primary" href="$URL" <% if $OpenInNew %>target="_blank" rel="noopener noreferrer"<% end_if %>>$Title</a>
                                </p>
                            </div>
                        <% end_if %>
                    <% end_with %>
                </div>
            </div>
        <% end_loop %>
    </div>
</div>
