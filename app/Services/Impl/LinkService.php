<?php

namespace App\Services\Impl;

use App\Models\Link;
use App\Services\Intf\ILinkService;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class LinkService extends CommonService implements ILinkService
{
    protected function getDefaultModel()
    {
        return Link::getTableName();
    }

    protected function getDefaultClass()
    {
        return Link::class;
    }

    /**
     * @param $filter
     * @return mixed
     */
    public function search($filter)
    {
        $limit = isset($filter['limit']) ? $filter['limit'] : config('const.LIMIT_PER_PAGE');
        $query = Link::where('is_deleted', '=', 0);

        $sorder_type = isset($filter['order_type']) ? $filter['order_type'] : 'created_at';
        $sdir = isset($filter['sdir']) ? $filter['sdir'] : 'desc';

        if ($sorder_type) {
            $query->orderBy($sorder_type, $sdir);
        }

        $rResult = $query->paginate($limit)->toArray();
        return $rResult;
    }

    public function findById($id)
    {
        return Link::where('id', '=', $id)->first();
    }

    public function findByKey($key)
    {
        $rResult = Link::where('key', '=', $key)->first();
        return array('setting' => $rResult);
    }

    public function create($arrInput)
    {
        $link = new Link($arrInput);
        DB::beginTransaction();
        try {
            $link->save();
            DB::commit();
            return $link;
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update($arrInput)
    {
        $id = $arrInput['id'];
        DB::beginTransaction();
        try {
            $version = Link::find($id);
            $version->update($arrInput);
            DB::commit();
            return $version;
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
