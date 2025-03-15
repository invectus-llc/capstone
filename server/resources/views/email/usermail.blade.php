@foreach ($data as $item)
    <section
        style="padding-left: 1.5rem; padding-right: 1.5rem; padding-top: 2rem; padding-bottom: 2rem; margin-left: auto; margin-right: auto; background-color: #ffffff">
        <main style="margin-top: 2rem; ">
            <h2 style="color: #374151; ">Hi {{ $item['firstname'] }},</h2>

            <p style="margin-top: 0.5rem; color: #4B5563; line-height: 2; ">
                You Have An Upcoming Event: <span style="font-weight: 600;">{{ $item['name'] }}</span>.
            </p>
            <p style="margin-top: 0.5rem; color: #4B5563; line-height: 2; ">
                Starting From: <span style="font-weight: 600;">{{ $item['startDate'] }}</span>.
            </p>
            <p style="margin-top: 0.5rem; color: #4B5563; line-height: 2; ">
                Until: <span style="font-weight: 600;">{{ $item['endDate'] }}</span>.
            </p>

            <p style="margin-top: 0.5rem;  color: #4B5563; line-height: 2; ">
                Thanks, <br>
                People Center Tacloban
            </p>
        </main>
        <footer style="margin-top: 2rem; ">
            <p style="color: #6B7280;">
                This email was sent to <a href="#" style="color: #2563EB; :hover {text-decoration: underline;}"
                    target="_blank">{{ $item['email'] }}</a>.
                If you'd rather not receive this kind of email, you can <a href="#"
                    style="color: #2563EB; :hover {text-decoration: underline;}">unsubscribe</a> or <a href="#"
                    style="color: #2563EB; :hover {text-decoration: underline;}">manage your email
                    preferences</a>.
            </p>
            <p style="margin-top: 0.75rem; color: #6B7280; ">© {{ date('Y') }} People Center Tacloban.
                All
                Rights
                Reserved.</p>
        </footer>
    </section>
@endforeach
