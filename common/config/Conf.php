<?php

namespace common\config;


class Conf
{
    /** ����ģ�� */
    const ARTICLE_MODEL = 1;
    /** ���ģ�� */
    const ALBUM_MODEL = 2;

    /** ���ݿ��� */
    const ENABLE = 0;
    /** ���ݲ����� */
    const DISABLE = 1;

    const GRADUATION_IMG = 1;
    const SHI_NEI_IMG = 2;
    const PING_MIAN_IMG = 3;
    const TAO_BAO_IMG = 4;

    /** Ĭ���ϴ�Ŀ¼ */
    const UPLOAD_DEFAULT_DIR = 'uploads';
    const THUMB_DEFAULT = 'public/common/images/thumb_default.jpg';

    /** ����Ϊ��Ĭ��ͼƬ��ʾ */
    const EMPTY_DATA = 'public/common/images/none_data.png';

    /** ϵͳĬ�ϵ�һ������ */
    const CAT_FRONTEND = 1; //ǰ�˷���
    const CAT_BACKEND = 2; //��˷���
    const CAT_DATABASE = 3; //���ݿ����
    const CAT_SERVER = 4; //����������
}