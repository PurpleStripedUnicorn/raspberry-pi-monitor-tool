<?php # make sure file gets identified as PHP ?>
<table>
    <tbody>

        <tr><th colspan=2>CPU</th></tr>

        <tr class="cpu_usage_alert">
            <td colspan=2>This feature isn't fully available, please install
            sysstat to see data about cpu load</td>
        </tr>

        <tr class="cpu_usage_item">
            <td>cpu usage (total)</td>
            <td data-output="cpu_usage_color">
                <span data-output="cpu_usage">0</span>%
            </td>
        </tr>
        <tr class="cpu_usage_item">
            <td>cpu usage (core0)</td>
            <td data-output="cpu_usage_color_core0">
                <span data-output="cpu_usage_core0">0</span>%
            </td>
        </tr>
        <tr class="cpu_usage_item">
            <td>cpu usage (core1)</td>
            <td data-output="cpu_usage_color_core1">
                <span data-output="cpu_usage_core1">0</span>%
            </td>
        </tr>
        <tr class="cpu_usage_item">
            <td>cpu usage (core2)</td>
            <td data-output="cpu_usage_color_core2">
                <span data-output="cpu_usage_core2">0</span>%
            </td>
        </tr>
        <tr class="cpu_usage_item">
            <td>cpu usage (core3)</td>
            <td data-output="cpu_usage_color_core3">
                <span data-output="cpu_usage_core3">0</span>%
            </td>
        </tr>
        <tr>
            <td>cpu temperature</td>
            <td>
                <span data-output="cpu_temp">0°C</span>
            </td>
        </tr>

    </tbody>
</table>
<table>
    <tbody>

        <tr><th colspan=2>Storage</th></tr>

        <tr>
            <td>total storage</td>
            <td data-output="storage_total">
                0G
            </td>
        </tr>
        <tr>
            <td>storage free</td>
            <td data-output="storage_free">
                0G
            </td>
        </tr>
        <tr>
            <td>storage used</td>
            <td data-output="storage_used">
                0G
            </td>
        </tr>

    </tbody>
</table>
<table>
    <tbody>

        <tr><th colspan=2>RAM</th></tr>

        <tr>
            <td>RAM total</td>
            <td data-output="ram_total">
                0M
            </td>
        </tr>
        <tr>
            <td>RAM used</td>
            <td data-output="ram_used">
                0M
            </td>
        </tr>
        <tr>
            <td>RAM free</td>
            <td data-output="ram_free">
                0M
            </td>
        </tr>
        <tr>
            <td>RAM shared</td>
            <td data-output="ram_shared">
                0M
            </td>
        </tr>
        <tr>
            <td>RAM buff/cache</td>
            <td data-output="ram_buff_cache">
                0M
            </td>
        </tr>
        <tr>
            <td>RAM available</td>
            <td data-output="ram_available">
                0M
            </td>
        </tr>

    </tbody>
</table>
