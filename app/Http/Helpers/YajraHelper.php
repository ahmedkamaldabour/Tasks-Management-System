<?php


function get_lang()
{
    return (app()->getLocale() === 'ar') ?
        [
            'url' => url('//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json')
        ] :
        [
            'url' => url('//cdn.datatables.net/plug-ins/1.10.25/i18n/English.json')
        ];
}

function change_column_lang($row)
{
    if (app()->getLocale() === 'ar') {
        if ($row->changed_column === 'title') {
            return 'العنوان';
        } elseif ($row->changed_column === 'description') {
            return 'الوصف';
        } elseif ($row->changed_column === 'payment_status') {
            return 'حالة الدفع';
        } elseif ($row->changed_column === 'status_id') {
            return 'حالة المهمة';
        } elseif ($row->changed_column === 'phase_id') {
            return 'المرحلة';
        } elseif ($row->changed_column === 'reporter_id') {
            return 'المبلغ';
        } elseif ($row->changed_column === 'assigned_id') {
            return 'الموظف المسؤول';
        } elseif ($row->changed_column === 'client_id') {
            return 'العميل';
        }
    }
    return __(ucfirst(explode('_', $row->changed_column)[0]));
}


function task_history_values($row, $type , $flag = 0)
{
    if (is_array(json_decode($type, true))) {
        $type = json_decode($type, true);
        return implode('<br>', $type);
    }
    if ($flag) {
        return new_value($row);
    }
    return old_value($row);
}

function old_value($row)
{
    if ($row->changed_column == 'phase_id') {
        return $row->phase_old_value->name;
    }
    elseif ($row->changed_column == 'status_id') {
        return $row->status_old_value->name;
    }
    elseif ($row->changed_column == 'assigned_id') {
        return $row->assigned_old_value->name;
    }
    elseif ($row->changed_column == 'client_id') {
        return $row->client_old_value->name;
    }
    return $row->old_value;
}

function new_value($row)
{
    if ($row->changed_column == 'phase_id') {
        return $row->phase_new_value->name;
    }
    elseif ($row->changed_column == 'status_id') {
        return $row->status_new_value->name;
    }
    elseif ($row->changed_column == 'assigned_id') {
        return $row->assigned_new_value->name;
    }
    elseif ($row->changed_column == 'client_id') {
        return $row->client_new_value->name ;
    }
    return $row->new_value;

}
