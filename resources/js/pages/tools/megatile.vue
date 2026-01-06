<script setup lang="ts">
import Callout from '@/components/Callout.vue';
import Heading from '@/components/Heading.vue';
import Showcase from '@/components/Showcase.vue';
import SubHeading from '@/components/SubHeading.vue';

const tableOfContents = [
    { title: 'Overview', level: 1 },
    { title: 'Features', level: 1 },
    { title: 'Keybindings', level: 1 },
    { title: 'Installation', level: 1 },
    { title: 'Status', level: 1 },
    { title: 'Suggestions', level: 1 },
];

const technologies = [
    { name: 'Rust', color: 'rust' },
    { name: 'Windows API', color: 'default' },
];

const gallery = [
    {
        src: '/images/megatile_1.png',
        alt: 'Megatile',
        caption: 'Two windows split vertically, Megatile!',
    },
    {
        src: '/images/megatile_2.png',
        alt: 'Megatile',
        caption: 'Five windows split in a custom layout, Megatile!',
    },
];
</script>

<template>
    <Showcase
        title="Megatile"
        tagline="An opinionated tiling window manager for Windows"
        github-url="https://github.com/LostRhapsody/megatile"
        status="Beta"
        version="0.2.0"
        :technologies="technologies"
        :outline="tableOfContents"
        :gallery="gallery"
    >
        <Heading title="Overview" />
        <p>
            Megatile is a minimalist tiling manager that does the bare minimum
            to be effective. It has a standardized set of keybinds, a very
            simple status bar, and a single tiling algorithm.
        </p>
        <p>
            Megatile will <strong>not</strong> suit everyone. It was designed to
            suit my needs exactly. There is no config file, to keep Megatile as
            simple as possible.
        </p>

        <Callout type="info" title="Design Philosophy">
            <p>
                Megatile prioritizes simplicity and speed over configurability.
                If you need extensive customization options, consider checking
                out
                <a
                    href="https://github.com/glzr-io/glazewm"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="text-blue-400 underline hover:text-blue-300"
                    >GlazeWM</a
                >, which offers a full configuration language and customizable
                status bar.
            </p>
        </Callout>

        <Heading title="Features" />
        <p>Megatile aims to be simple, fast, and effective:</p>
        <ul class="list-disc space-y-2 pl-6">
            <li>
                <strong>Fast:</strong> Built with Rust using bindings for the
                Windows API via <code>windows-rs</code>. Minimal dependencies
                and responsibilities for near-instant response time.
            </li>
            <li>
                <strong>Simple:</strong> We manage windows, workspaces, and
                keybinds to control them - nothing else. No bloat, no
                unnecessary features.
            </li>
            <li>
                <strong>Effective:</strong> Manage 1-9 workspaces with
                near-instant response time. No animations, no lag, just pure
                efficiency.
            </li>
            <li>
                <strong>System Tray:</strong> Runs quietly in the system tray.
                Right-click the icon to exit when needed.
            </li>
            <li>
                <strong>Intelligent Filtering:</strong> Automatically filters
                windows that shouldn't be tiled, like system dialogs and popup
                windows.
            </li>
            <li>
                <strong>Multiple Monitors:</strong> Full support for multiple
                monitors. All monitors share the same workspace for seamless
                workflow.
            </li>
            <li>
                <strong>Dwindle Tiling:</strong> Uses efficient binary space
                partitioning. Just one algorithm, optimized and reliable.
            </li>
            <li>
                <strong>Status Bar:</strong> Minimalist status bar showing
                workspaces 1-5 by default, the active workspace, and the current
                date and time. Workspaces 6-9 appear automatically when in use.
            </li>
        </ul>

        <Heading title="Keybindings" />
        <p>
            All keybindings use <code>Alt</code> as the modifier key. Here's the
            complete reference:
        </p>

        <SubHeading title="Window Navigation" />
        <div
            class="overflow-x-auto rounded-lg border border-orange-500/40 bg-slate-900/50"
        >
            <table class="w-full font-mono text-sm">
                <thead>
                    <tr
                        class="border-b border-orange-500/30 bg-slate-800/50 text-left"
                    >
                        <th class="w-1/3 px-4 py-3 text-amber-400">
                            Keybinding
                        </th>
                        <th class="w-2/3 px-4 py-3 text-amber-400">Action</th>
                    </tr>
                </thead>
                <tbody class="text-orange-100/80">
                    <tr class="border-b border-orange-500/20">
                        <td class="px-4 py-3">
                            <code>Alt + Arrows</code>
                        </td>
                        <td class="px-4 py-3">Move focus between windows</td>
                    </tr>
                    <tr class="border-b border-orange-500/20">
                        <td class="px-4 py-3">
                            <code>Alt + Shift + Arrows</code>
                        </td>
                        <td class="px-4 py-3">Swap window positions</td>
                    </tr>
                    <tr class="border-b border-orange-500/20">
                        <td class="px-4 py-3">
                            <code>Alt + Ctrl + Arrows</code>
                        </td>
                        <td class="px-4 py-3">Move windows between monitors</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <SubHeading title="Workspace Management" />
        <div
            class="overflow-x-auto rounded-lg border border-orange-500/40 bg-slate-900/50"
        >
            <table class="w-full font-mono text-sm">
                <thead>
                    <tr
                        class="border-b border-orange-500/30 bg-slate-800/50 text-left"
                    >
                        <th class="w-1/3 px-4 py-3 text-amber-400">
                            Keybinding
                        </th>
                        <th class="w-2/3 px-4 py-3 text-amber-400">Action</th>
                    </tr>
                </thead>
                <tbody class="text-orange-100/80">
                    <tr class="border-b border-orange-500/20">
                        <td class="px-4 py-3">
                            <code>Alt + 1-9</code>
                        </td>
                        <td class="px-4 py-3">Switch to workspace 1-9</td>
                    </tr>
                    <tr class="border-b border-orange-500/20">
                        <td class="px-4 py-3">
                            <code>Alt + Shift + 1-9</code>
                        </td>
                        <td class="px-4 py-3">
                            Move focused window to workspace 1-9
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <SubHeading title="Window Control" />
        <div
            class="overflow-x-auto rounded-lg border border-orange-500/40 bg-slate-900/50"
        >
            <table class="w-full font-mono text-sm">
                <thead>
                    <tr
                        class="border-b border-orange-500/30 bg-slate-800/50 text-left"
                    >
                        <th class="w-1/3 px-4 py-3 text-amber-400">
                            Keybinding
                        </th>
                        <th class="w-2/3 px-4 py-3 text-amber-400">Action</th>
                    </tr>
                </thead>
                <tbody class="text-orange-100/80">
                    <tr class="border-b border-orange-500/20">
                        <td class="px-4 py-3">
                            <code>Alt + W</code>
                        </td>
                        <td class="px-4 py-3">Close focused window</td>
                    </tr>
                    <tr class="border-b border-orange-500/20">
                        <td class="px-4 py-3">
                            <code>Alt + T</code>
                        </td>
                        <td class="px-4 py-3">
                            Toggle focused window's tiling state
                        </td>
                    </tr>
                    <tr class="border-b border-orange-500/20">
                        <td class="px-4 py-3">
                            <code>Alt + F</code>
                        </td>
                        <td class="px-4 py-3">
                            Toggle focused window to fullscreen
                        </td>
                    </tr>
                    <tr class="border-b border-orange-500/20">
                        <td class="px-4 py-3">
                            <code>Alt + J</code>
                        </td>
                        <td class="px-4 py-3">Flip current region</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <SubHeading title="Layout & Interface" />
        <div
            class="overflow-x-auto rounded-lg border border-orange-500/40 bg-slate-900/50"
        >
            <table class="w-full font-mono text-sm">
                <thead>
                    <tr
                        class="border-b border-orange-500/30 bg-slate-800/50 text-left"
                    >
                        <th class="w-1/3 px-4 py-3 text-amber-400">
                            Keybinding
                        </th>
                        <th class="w-2/3 px-4 py-3 text-amber-400">Action</th>
                    </tr>
                </thead>
                <tbody class="text-orange-100/80">
                    <tr class="border-b border-orange-500/20">
                        <td class="px-4 py-3">
                            <code>Alt + B</code>
                        </td>
                        <td class="px-4 py-3">Toggle the status bar</td>
                    </tr>
                    <tr class="border-b border-orange-500/20">
                        <td class="px-4 py-3">
                            <code>Alt + +/-</code>
                        </td>
                        <td class="px-4 py-3">Resize horizontally</td>
                    </tr>
                    <tr class="border-b border-orange-500/20">
                        <td class="px-4 py-3">
                            <code>Alt + Shift + +/-</code>
                        </td>
                        <td class="px-4 py-3">Resize vertically</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <Callout type="tip" title="Keybind Design">
            <p>
                I've opted to use the <code>Alt</code> key as the modifier key
                for all keybindings. This avoids conflicts with the Windows key,
                but could conflict with other common keybinds, depending on your
                workflow.
            </p>
            <br />
            <p>
                Personally I don't find it conflicts with anything in my
                day-to-day work.
            </p>
        </Callout>

        <Heading title="Installation" />
        <p>
            Currently, there is no installer or binary distribution. You'll need
            to build from source.
        </p>
        <Callout type="info" title="Future installer">
            <p>
                An installer will be hosted on this site in the near future to
                make installing easy and seamles.
            </p>
        </Callout>

        <SubHeading title="Prerequisites" />
        <ul class="list-disc space-y-2 pl-6">
            <li>Rust installed with dependencies</li>
            <li>Windows operating system</li>
            <li>Git installed</li>
        </ul>

        <SubHeading title="Build Steps" />
        <div class="rounded-lg border border-orange-500/40 bg-slate-900/50 p-4">
            <pre
                class="font-mono text-sm text-green-400"
            ><code># Clone the repository
git clone https://github.com/LostRhapsody/megatile
cd megatile

# Build the release version
cargo build --release

# Run Megatile
./target/release/megatile.exe</code></pre>
        </div>
        <p class="mt-4">
            Megatile will now be running in the background. You can find the
            orange square icon in the system tray. Right-click it and select
            "Exit" to stop the application.
        </p>

        <Heading title="Status" />
        <p>
            <strong>Version 0.2.0 - Beta Release:</strong> Megatile is nearly
            feature-complete and ready for daily use. However, as with any beta
            software, you may encounter bugs. Please report any issues on the
            GitHub repository.
        </p>

        <SubHeading title="Planned Features" />
        <p>
            These features are planned but have no specific timeline, as they
            are not currently a priority:
        </p>
        <ul class="list-disc space-y-2 pl-6">
            <li>
                <strong>Website:</strong> A dedicated Megatile website with
                documentation and distribution service (install.sh).
            </li>
            <li>
                <strong>Keybind Configuration:</strong> Allow keybinds to be
                rebound in case they conflict with existing user setups. For
                now, you could use AutoHotkey to remap them if needed.
            </li>
        </ul>

        <Heading title="Suggestions" />
        <p>
            For the best experience, I recommend pairing Megatile with a fast
            launcher like <strong>Raycast</strong> or
            <strong>PowerToys Run</strong>. A speedy launcher combined with
            efficient tiling makes for an excellent desktop workflow.
        </p>

        <Callout type="info" title="Alternatives">
            <p>
                If you'd like more customizability, check out
                <a
                    href="https://github.com/glzr-io/glazewm"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="text-blue-400 underline hover:text-blue-300"
                    >GlazeWM</a
                >, another tiling manager for Windows that is very i3-like, with
                a full configuration language and a customizable status bar
                called
                <a
                    href="https://github.com/glzr-io/zebar"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="text-blue-400 underline hover:text-blue-300"
                    >Zebar</a
                >.
            </p>
        </Callout>

        <SubHeading title="Contributing" />
        <p>
            Contributions are welcome, with the caveat that the project is
            intentionally opinionated and minimal:
        </p>
        <ul class="list-disc space-y-2 pl-6">
            <li>
                Bug reports and issue descriptions with clear reproduction steps
                are very helpful.
            </li>
            <li>
                Pull requests should stay aligned with the project's direction.
            </li>
            <li>
                Features that add significant complexity or configurability may
                be declined if they conflict with the project's philosophy.
            </li>
        </ul>
        <p>
            Before working on a larger change, consider opening a discussion on
            GitHub to talk about the idea.
        </p>
    </Showcase>
</template>
