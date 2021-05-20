<div class="py-4 py-xl-7">
    <div class="container">
        <div class="col-12 text-center">
            <% if $ShowTitle %>
                <h3 class="mb-4">$MarkdownText.Title.RAW</h3>
            <% end_if %>
            <div class="mb-4">$Text</div>
            <% include Link %>
        </div>
    </div>
</div>

<% require css('biffbangpow/silverstripe-calltoaction-element:client/dist/styles/module.css') %>